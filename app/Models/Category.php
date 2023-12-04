<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'parent_id',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->category_id = (string) Str::uuid();
        });
    }
    
    public function childCategories()
    {
        return $this->hasMany(Category::class,'parent_id','category_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id','category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }
}
