@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
<div>
  <div class="mb-4 d-block d-md-none">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Decoration</a></li>
        <li class="breadcrumb-item"><a href="#">Furniture</a></li>
        <li class="breadcrumb-item"><a href="#">Storage</a></li>
        <li class="breadcrumb-item active" aria-current="page">Sideboard</li>
      </ol>
    </nav>
  </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="position-relative">
          @foreach ($products->first()->productImages as $index => $image)
              @if ($loop->first)
                  <img id="main-image" class="rounded-3" src="{{ asset('images/' . $image->image_name) }}" alt="Main Product Image">
                  <!-- Navigation Arrows -->
                  <div class="arrow-container">
                      <button class="arrow left btn btn-outline-none" aria-label="Previous">
                          <i class="fas fa-chevron-left"></i>
                      </button>
                      <button class="arrow right btn btn-outline-none" aria-label="Next">
                          <i class="fas fa-chevron-right"></i>
                      </button>
                  </div>
              @endif
          @endforeach
      </div>
      
      <!-- Thumbnail Images -->
      <div class="d-flex gap-3 flex-wrap mt-4 flex-md-col img-slider">
          @foreach ($products->first()->productImages as $index => $image)
              <div class="" style="cursor: pointer">
                  <img src="{{ asset('images/' . $image->image_name) }}" data-src="{{ asset('images/' . $image->image_name) }}" class="img-thumbnail" alt="Thumbnail" onclick="changeMainImage(this)">
              </div>
          @endforeach
      </div>
    </div>

        <div class="right-side col-md-6">
          <div class="mb-5 d-none d-md-block">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">Decoration</a></li>
                  <li class="breadcrumb-item"><a href="#">Furniture</a></li>
                  <li class="breadcrumb-item"><a href="#">Storage</a></li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Sideboard
                  </li>
                </ol>
              </nav>
          </div>

        <div class="">
            @foreach ($products as $pro)
            <h1 class="fs-3 mb-2 mt-5 mt-md-0 text-shadow">{{$pro->product_name}}</h1>
            <p class="fs-6 mb-1 subtitle text-shadow-slider">{{$pro->product_subtitle}}</p>
            <hr class="break-line shadow" />

            <div class="d-flex gap-5 align-items-center mt-4 mb-5">
                @php
                    $price = $pro->product_price * 1.25;
                @endphp
                <div class="fs-2 fw-bold amount">${{$pro->product_price}}</div>
                <div>
                  <div class="d-flex align-items-center">
                    <div class="rounded-pill px-3 py-1 me-2 rating">
                      <i class="fas fa-star text-warning"></i> 4.8
                    </div>
                    <div class="rounded-pill px-3 py-1 review">
                      <i class="fas fa-comment-dots"></i> 67 Reviews
                    </div>
                  </div>
                  <div class="recommended">
                    <span>93% </span> of buyers have recommended this.
                  </div>
                </div>
              </div>

            <hr class="break-line" />
            <div class="my-4 color-container">
              <label class="title fs-6">Choose a Color:</label>
              <div class="d-flex gap-4">
                <div class="color-circle" data-color="color1" style="background-color: #ECDECC"></div>
                <div class="color-circle" data-color="color2" style="background-color: #BBD278"></div>
                <div class="color-circle" data-color="color3" style="background-color: #BBC1F8"></div>
                <div class="color-circle" data-color="color4" style="background-color: #FFD3F8"></div>
                <div class="color-circle" data-color="color5" style="background: linear-gradient(to top, #FFB6B6, #98C185)"></div>
              </div>
            </div>

            <hr class="break-line" />

            <div class="size-container">
                <label class="title mb-3">Choose a Size:</label>
                <div class="d-flex gap-2 flex-wrap">
                  <label class="size-circle custom-radio">
                    <input type="radio" name="size" id="size1" /> Small
                    <span class="radio-button"></span>
                  </label>
                  <label class="size-circle custom-radio">
                    <input type="radio" name="size" id="size2" /> Medium
                    <span class="radio-button"></span>
                  </label>
                  <label class="size-circle custom-radio">
                    <input type="radio" name="size" id="size3" /> Large
                    <span class="radio-button"></span>
                  </label>
                  <label class="size-circle custom-radio">
                    <input type="radio" name="size" id="size4" /> Extra Large
                    <span class="radio-button"></span>
                  </label>
                  <label class="size-circle custom-radio">
                    <input type="radio" name="size" id="size5" /> XXL
                    <span class="radio-button"></span>
                  </label>
                </div>
              </div>

             <hr class="break-line" />
            
            <div class="d-md-flex align-items-center gap-3 amount-container">
              <div class="d-flex align-items-center mb-3 mb-md-0 amount-number-container">
                <button class="btn btn-outline-none pl-2 fw-bold" id="decrement"> -  </button>
                <input type="text" id="quantity" class="form-control text-center mx-2 border-none amount-number fw-bold"
                  value="1" />
                <button class="btn btn-outline-none fw-bold" id="increment"> + </button>
              </div>
              <button class="btn btn-primary btn-lg price" id="addToCartBtn" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">${{$price}} Add To Cart</button>
            </div>            
        </div>
    </div>
</div>

<div class="tab-container">
  <ul class="tabs">
    <li class="fs-6 tab active">Description</li>
  </ul>
  <div class="description">
    <div class="product-desc">
      <h5 class="title">Product Description</h5>
      <p class="paragraph fs-6">{{$pro->description}}</p>
    </div>
    @endforeach
    <div class="benefit">
      <h5 class="title">Benefits</h5>
      <div class="tick-container">
        @foreach($pro->productBenefit as $benefit)
        <p class="paragraph">{{ $benefit->benefit_name }} </p>
        @endforeach
      </div>
    </div>
    <div class="product-details">
      <h5 class="title">Product Details</h5>
      <div class="tick-container">
        @foreach($pro->productDetails as $details)
        <p class="paragraph">
          {{ $details->details_name }}
        </p>
        @endforeach
      </div>
    </div>
    <div class="more-details">
      <h5 class="title">More Details</h5>
      <div class="tick-container">
        @foreach($pro->productMoreDetails as $moredetails)
        <p class="paragraph">
          {{ $moredetails->more_details_name }}
        </p>
        @endforeach
      </div>
    </div>
  </div>
</div>

{{-- modal --}}

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 10px; padding: 20px;">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 24px; color: #000;"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center mb-4">
                  @foreach ($products->first()->productImages as $index => $image)
                  @if ($loop->first)
                    <img src="{{ asset('images/' . $image->image_name) }}" alt="Product Image" style="width: 100px; height: 120px; border-radius: 12px; object-fit: cover;" class="me-3">
                  @endif
                  @endforeach  
                    <div>
                        <div class="product-title" style="font-size: 18px; font-weight: 700; margin-bottom: 4px;">{{$pro->product_name}}</div>
                        <div class="product-subtitle" style="font-size: 14px; color: #666;">{{$pro->product_subtitle}}</div>
                        <p hidden id="productId">{{$pro->id}}</p>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">                                       
                        <div class="color-circle d-none" data-color="color1" style="background-color: #ECDECC"></div>
                        <div class="color-circle d-none" data-color="color2" style="background-color: #BBD278"></div>
                        <div class="color-circle d-none" data-color="color3" style="background-color: #BBC1F8"></div>
                        <div class="color-circle d-none" data-color="color4" style="background-color: #FFD3F8"></div>
                        <div class="color-circle d-none" data-color="color5" style="background: linear-gradient(to top, #FFB6B6, #98C185)"></div>
                        <div class="size-label" id="modalSelectedSize" style="font-size: 14px; margin-left:30px; background-color: #f0f0f0; padding: 6px 12px; border-radius: 8px;"></div>                      
                    </div>
                    <div class="quantity-control" style="display: flex; align-items: center; background-color: #f3f3f3; border-radius: 30px; padding: 10px 43px;">
                        <button id="modalDecrement" class="btn p-0" style="background: none; border: none; margin-right:20px; font-size: 24px; color: #3a4980;">-</button>
                        <span id="modalQuantity" style="font-size: 18px; font-weight: 700; color: #3a4980; margin: 0 10px;">1</span>
                        <button id="modalIncrement" class="btn p-0" style="background: none; border: none; margin-left:20px; font-size: 24px; color: #3a4980;">+</button>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" id="proceedToCheckoutBtn" class="btn btn-primary" style="font-size: 18px; background-color: #3A4B8D; padding: 6px 90px; border-radius: 50px; font-weight: 700;">
                        $<span id="modalTotalPrice">{{ $price }}</span> Buy Now
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
