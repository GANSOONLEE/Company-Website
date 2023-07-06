<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\Product;
use Illuminate\Support\Str;


class Image extends Model
{
    use HasFactory;

    /**
     *  @param
     * 
     */
    

    protected $table = 'image';
    public $timestamps = FALSE;
    protected $primaryKey = 'imageID';
    protected $fillable = [
        'imageID', 
        'imagePath',
        'isPrimaryImage',
        'productID'
    ];

    /**
     *  定義關聯性
     *  @return object;
     */

    function rel_product(): object{
        return $this->hasOne(Product::class, 'productID', 'productID');
    }

    

    /**
     *  新增、修改、刪除
     *  @method
     *  @return void
     */

}
