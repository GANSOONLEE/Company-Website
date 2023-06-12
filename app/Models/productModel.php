<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class productModel extends Model{
    protected $table = 'models';
    protected $primaryKey = 'modelID';
    protected $fillable = ['modelName'];
    public $timestamps = false;

    /**
    * 关联关系：一个车款拥有多个产品
    */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_model', 'modelID', 'productID');
    }

    /**
     * 创建新车款
     *
     * @param array $data
     * @return \App\Models\productModel
     */
    public static function createModel($data){

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
                self::create(['modelName' => $line]);
            }
        }
    }

    /**
     * 更新车款
     *
     * @param int $modelID
     * @param array $data
     * @return bool
     */
    public static function updateProduct($modelID, $data)
    {
        return self::where('modelID', $modelID)->update($data);
    }

    /**
     * 删除车款
     *
     * @param int $modelID
     * @return bool
     */
    public static function deleteProduct($modelID)
    {
        return self::where('modelID', $modelID)->delete();
    }
}