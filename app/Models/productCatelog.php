<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class productCatelog extends Model{
    protected $table = 'catelog';
    protected $primaryKey = 'catelogID';
    protected $fillable = ['catelogName'];
    public $timestamps = false;
    /**
    * 关联关系：一个种类拥有多个产品
    */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_catelog', 'catelogID', 'productID');
    }

    /**
     * 创建新种类
     *
     * @param array $data
     * @return \App\Models\productCatelog
     */
    public static function createCatelog($data){

        // 确保传递的参数是一个字符串
        if (!is_string($data)) {
            return; // 返回空值或抛出异常，根据你的需求
        }

        // 将输入数据按行分割为数组
        $lines = explode("\n", $data);

        // 遍历每行数据并创建新的产品种类
        foreach ($lines as $line) {
            $line = trim($line);

            // 确保行数据不为空
            if (!empty($line)) {
                self::create(['catelogName' => $line]);
            }
        }
    }


    /**
     * 更新种类
     *
     * @param int $catelogID
     * @param array $data
     * @return bool
     */
    public static function updateProduct($catelogID, $data)
    {
        return self::where('catelogID', $catelogID)->update($data);
    }

    /**
     * 删除种类
     *
     * @param int $catelogID
     * @return bool
     */
    public static function deleteProduct($catelogID)
    {
        return self::where('catelogID', $catelogID)->delete();
    }
}