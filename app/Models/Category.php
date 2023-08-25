<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'categoryID';

    protected $fillable = [
        'categoryName'
    ];

    public $timestamps = false;

    /**
     *  relationship 
     */

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     *  get product with category
     */

    public function get_product_with_category($categoryName)
    {
        return $this->products()
            ->where('category_name', $categoryName) // 假设你的 products 表中有一个 category_name 字段存储类别名称
            ->first();
    }
    
}
