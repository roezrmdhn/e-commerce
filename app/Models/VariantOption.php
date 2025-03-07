<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{
    use HasFactory;

    protected $fillable = ['variant_id', 'name'];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_variants');
    }
}
