<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];


    // Subcategory
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    // Product
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
