<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'categories';

    protected $fillable = [
        'category_id',
        'name',
        'parent_id',
    ];
    protected $primaryKey = 'category_id';
    protected $keyType = 'string';

    public $incrementing = false;
    
    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id','category_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id','category_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
    }
}
