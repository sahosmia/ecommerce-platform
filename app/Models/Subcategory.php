<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Subcategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['category_id', 'name', 'slug'];

    // Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Product
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

       protected static function booted(): void
    {
        static::deleting(function (Subcategory $subcategory) {
            if ($subcategory->isForceDeleting()) {
                $subcategory->products()->withTrashed()->get()->each->forceDelete();
            }
        });
    }
}
