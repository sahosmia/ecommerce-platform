<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    use HasFactory, SoftDeletes;

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

    protected static function booted(): void
    {
        static::deleting(function (Category $category) {
            if ($category->isForceDeleting() && ($category->subcategories()->withTrashed()->exists() || $category->products()->withTrashed()->exists())) {
                return false;
            }
        });
    }
}
