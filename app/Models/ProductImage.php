<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'image_url',
        'product_id',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    // public static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         $model->id = (string) Str::uuid();
    //     });
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
