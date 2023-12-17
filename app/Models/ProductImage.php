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
    protected $table = 'product_images';
    protected $primaryKey = 'image_id';
    protected $keyType = 'string';

    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
