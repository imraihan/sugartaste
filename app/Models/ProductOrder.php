<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','total','quantity','color','size'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
