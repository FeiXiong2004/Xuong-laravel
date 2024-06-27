<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable=[
        'products_id',
        'product_size_id',
        'product_color_id',
        'quantity',
        'image',
        
    ];
    public function products(){
        return $this->belongsTo(Products::class);
    }
}
