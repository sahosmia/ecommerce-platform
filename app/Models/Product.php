<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;




class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'description',
        'image',
        'price',
        'discount_type',
        'discount_value',
        'slug'
    ];

    // Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Subcategory
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    // New Price Accessor
    protected function newPrice(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $originalPrice = (float) $attributes['price'];
                $discountValue = (float) $attributes['discount_value'];
                $discountType  = $attributes['discount_type'];
                $newPrice      = $originalPrice;

                if ($discountType === 'percentage') {
                    $discountAmount = ($originalPrice * $discountValue) / 100;
                    $newPrice = $originalPrice - $discountAmount;
                } elseif ($discountType === 'fixed') {
                    $newPrice = $originalPrice - $discountValue;
                }

                return max(0, round($newPrice, 2)); // নেগেটিভ দাম এড়িয়ে যেতে
            },
        );
    }


    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Check if the image path is available in the database
                if ($attributes['image']) {
                    // Assuming images are stored in the 'public' disk under a 'products' folder
                    return Storage::url('products/' . $attributes['image']);
                }

                // If 'image' is null, return the path to a default placeholder image
                return asset('images/default-product.png');
            },
        );
    }


     protected static function booted(): void
    {
        static::deleting(function (Product $product) {
            if ($product->isForceDeleting()) {
                if ($product->image) {
                    $filePath = 'products/' . $product->image;
                    if (Storage::disk('public')->exists($filePath)) {
                        Storage::disk('public')->delete($filePath);
                    }
                }
            }
        });
    }
}
