<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model{

    use SoftDeletes;

    protected $table = 'products';
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'product_id';
    protected $guarded = [ ];
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = [
        'product_id',
        'product_category',
        'product_type',
        'product_name_list',
        'product_brand_list',
        'product_status',
    ];

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

    public function scopeSearchByName($query, $keywords)
    {
        $resultsQuery = DB::table('products')->where('id', null);

        foreach ($keywords as $keyword) {
            $keyword = '%' . $keyword . '%';

            $queryResults = $query->orWhere(function ($subQuery) use ($keyword) {
                $subQuery->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(product_name_list, '$[*]')) LIKE ?", [$keyword]);
            });
    
            // 将每个查询结果添加到结果查询构建器中
            $resultsQuery->orWhereExists($queryResults->getQuery());
        }

        return $resultsQuery;
    }


}