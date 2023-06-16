<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\productModel;
use App\Models\catelogModel;

class Product extends Model{

    protected $table = 'products';
    protected $primaryKey = 'productID';
    protected $guarded = [ ];
    public $timestamps = false;

    /**
     * 一个产品只能有一种种类
     */
    public function catelog()
    {
        return $this->belongsTo(productModel::class, 'productCatelog', 'catelogID');
    }

    /**
     * 根据种类和车款获取产品列表
     *
     * @param string $category
     * @param string $model
     * @return \Illuminate\Database\Eloquent\Collection
     */
    
    public static function getByCategoryAndModel($category, $model)
    {
        return self::where('category', $category)
            ->where('model', $model)
            ->orderBy('productName', 'asc')
            ->get();
    }

    /**
     * 根据关键字查询产品
     *
     * @param string $keyword
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function searchByKeyword($keyword)
    {
        return self::where('productName', 'LIKE', "%$keyword%")
            ->orWhere('productCode', 'LIKE', "%$keyword%")
            ->orderBy('productName', 'asc')
            ->get();
    }

    /**
     * 创建新产品
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public static function createProduct($data)
    {
        return self::create($data);
    }

    /**
     * 更新产品
     *
     * @param int $productID
     * @param array $data
     * @return bool
     */
    public static function updateProduct($productID, $data)
    {
        return self::where('productID', $productID)->update($data);
    }

    /**
     * 删除产品
     *
     * @param int $productID
     * @return bool
     */
    public static function deleteProduct($productID)
    {
        return self::where('productID', $productID)->delete();
    }
}