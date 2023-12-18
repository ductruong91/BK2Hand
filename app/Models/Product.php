<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'time_used',
        'description',
        'status',
        'user_id',
    ];

    protected $primaryKey = 'product_id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected function timeUsedByWord(): Attribute
    {
        $months = $this->attributes['time_used'];
        $years = floor($months / 12);
        $remainingMonths = $months % 12;

        $result = [];
        if ($years > 0) {
            $result[] = $years . ' năm';
        }
        if ($remainingMonths > 0) {
            $result[] = $remainingMonths . ' tháng';
        }
        return Attribute::make(
            get: fn () => implode(', ', $result),
        );
    }

    protected function thumbnailImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->images()->first(),
        );
    }

    protected function categoryByWord(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->categories()->first()->name,
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class, 'product_id', 'product_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category','product_id','category_id');
    }
}
