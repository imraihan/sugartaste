$(document).ready(function() {
    $('.img-thumbnail').click(function() {
        var newSrc = $(this).data('src');
        $('#main-image').attr('src', newSrc);
    });

    // Handle arrow click
    $('.arrow').click(function() {
        var currentSrc = $('#main-image').attr('src');
        var thumbnails = $('.img-thumbnail');
        var currentIndex = thumbnails.toArray().findIndex(img => $(img).data('src') === currentSrc);
        
        if (currentIndex === -1) return; 

        var nextIndex = $(this).hasClass('right') ? (currentIndex + 1) % thumbnails.length : (currentIndex - 1 + thumbnails.length) % thumbnails.length;
        var nextSrc = $(thumbnails[nextIndex]).data('src');
        $('#main-image').attr('src', nextSrc);
    });
});

// slider
function changeMainImage(thumbnail) {
    $('#main-image').attr('src', $(thumbnail).data('src'));
}

// Size and color selection
$('.size-circle').on('click', function() {
    $('.size-circle').removeClass('active');
    $(this).addClass('active');
});

$('.color-circle').on('click', function() {
    $('.color-circle').removeClass('selected');
    $(this).addClass('selected');
});


var unitPrice = parseFloat($('.price').text().replace('$', '')); // Get the base price

function updatePrice() {
    var quantity = parseInt($('#quantity').val()); 
    var totalPrice = (quantity * unitPrice).toFixed(2); 
    $('.price').text('$' + totalPrice); 
    $('#addToCartBtn').html('$' + totalPrice + ' Add To Cart'); 
    $('#quantity').val(quantity); 

    $('#modalTotalPrice').text(totalPrice); // Update the price display
    $('#modalQuantity').text(quantity); // Update quantity display
    $('#cart-badge').text(quantity);
}

// Quantity increment and decrement
$('#increment').on('click', function() {
    let quantity = parseInt($('#quantity').val());
    $('#quantity').val(quantity + 1);
    updatePrice();
});

$('#decrement').on('click', function() {
    let quantity = parseInt($('#quantity').val());
    if (quantity > 1) {
        $('#quantity').val(quantity - 1);
        updatePrice();
    }
});

 // Direct input change
 $('#quantity').on('input', function() {
    var quantity = parseInt($(this).val());
    if (quantity < 1 || isNaN(quantity)) {
        $(this).val(1);
    }
    updatePrice(); 
});

let selectedColor = null;
let selectedSize = null;

function toggleAddToCartButton() {
    if (selectedColor && selectedSize) {
        $('#addToCartBtn').prop('disabled', false);
    } else {
        $('#addToCartBtn').prop('disabled', true);
    }
}

  // Update selected color on click
  $('.color-circle').on('click', function() {
    $('.color-circle').removeClass('selected');
    $(this).addClass('selected');
    selectedColor = $(this).attr('data-color');
    $('.modal-body .color-circle').removeClass('d-none');
    $('.modal-body .color-circle').addClass('d-none');
    $('.modal-body .color-circle[data-color="'+selectedColor+'"]').removeClass('d-none');
    toggleAddToCartButton();
});


// Update selected size on click
$('input[name="size"]').on('change', function() {
    selectedSize = $(this).closest('.size-circle').text().trim();

    toggleAddToCartButton();
});

    // Initial state - disable button
$('#addToCartBtn').prop('disabled', true);

$('#addToCartBtn').on('click', function() {
    var quantity = parseInt($('#quantity').val());
    var totalPrice = (quantity * unitPrice).toFixed(2);

    // Update the modal with quantity and total price
    $('#modalQuantity').text(quantity);
    $('#modalTotalPrice').text(totalPrice);

});


$(document).ready(function() {

    // Function to update the total price in the modal
    function updateModalTotalPrice() {
        const totalPrice = (quantity * unitPrice).toFixed(2); 
        $('#modalTotalPrice').text(totalPrice); // Update
        $('#modalQuantity').text(quantity); // Update 
        
        $('#quantity').val(quantity); // Update quantity 
        $('.price').text('$' + totalPrice); // Update price
        $('#addToCartBtn').html('$' + totalPrice + ' Add To Cart');
        
        $('#cart-badge').text(quantity); // Update the cart display
        
        $('#modalSelectedColor').text(selectedColor ? selectedColor : 'None');
        $('#modalSelectedSize').text(selectedSize ? selectedSize : 'None');
    }

    // Increment quantity
    $('#modalIncrement').click(function() {
        quantity++;
        $('#modalQuantity').text(quantity); // Update quantity 
        updateModalTotalPrice(); // Update total price 
    });

    // Decrement quantity
    $('#modalDecrement').click(function() {
        if (quantity > 1) {
            quantity--;
            $('#modalQuantity').text(quantity); // Update quantity 
            updateModalTotalPrice(); // Update total price 
        }
    });

    // Reset modal values 
    $('#exampleModalCenter').on('show.bs.modal', function (event) {
        quantity = $('#quantity').val(); 
        $('#modalQuantity').text(quantity);
        updateModalTotalPrice();
        toggleAddToCartButton();
    });
});

$('#proceedToCheckoutBtn').on('click', function() {
    var totalPrice = (quantity * unitPrice).toFixed(2);
    var productId = $('#productId').text();
    console.log(productId);

    $.ajax({
        url: '/cart', 
        method: 'POST',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {
            product_id: productId,
            quantity: quantity,
            total: totalPrice,
            color: selectedColor, 
            size: selectedSize  
        },
        success: function(response) {
            if (response.success) {
                alert('Product added to cart successfully!');

                $('#cart-badge').text(0);
                $('#addToCartBtn').html('$' + unitPrice + ' Add To Cart'); 
                $('#quantity').val(1);
                
                // Reset color selection
                $('.color-circle').removeClass('selected');
                selectedColor = ''; 
                
                // Reset size selection
                $('input[name="size"]').prop('checked', false);
                selectedSize = ''; 
                
                 // Disable the Add to Cart button
                 $('#addToCartBtn').prop('disabled', true);

                // Hide the modal
                $('#exampleModalCenter').modal('hide');
            } else {
                console.log('Failed to add product to cart.');
            }
        },
        error: function(xhr) {
            console.log('An error occurred: ' + xhr.responseText);
        }
    });

}); 

