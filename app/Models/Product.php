<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'sku',
        'stock',
        'is_active',
        'image'
    ];

    // Relasi ke ProductVariant
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'product_variants', 'product_id', 'variant_option_id');
    }
}
