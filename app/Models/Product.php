<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name','product_subtitle','product_price','description'];

    public function productBenefit() {
        return $this->hasMany(ProductBenefits::class);
    }

    public function productDetails() {
        return $this->hasMany(ProductDetails::class);
    }

    public function productImages() {
        return $this->hasMany(ProductImages::class);
    }

    public function productMoreDetails() {
        return $this->hasMany(ProductMoreDetails::class);
    }

    public function orders()
    {
        return $this->hasMany(ProductOrder::class);
    }
   
}
