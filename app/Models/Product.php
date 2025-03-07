<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'sku', 'stock', 'is_active', 'image'];

    public function variants()
    {
        return $this->belongsToMany(VariantOption::class, 'product_variants');
    }
}
