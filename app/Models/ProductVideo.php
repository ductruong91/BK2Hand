<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVideo extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'product_videos';

    protected $primaryKey = 'video_id';

    protected $fillable = [
        'video_url',
        'product_id',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
