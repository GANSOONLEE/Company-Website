<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     *  Setup
     */

    protected $table = 'cart';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'Email',
        'productID',
        'productBrand',
        'quantity'
    ];
    public $timestamps = false;

    /**
     *  Relationship
     */

    public function user(){
        return $this->hasOne(User::class, 'Email');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productID', 'productID');
    }

    public function cart_to_product()
    {
        return $this->product()->first(); // 返回关联的User模型
    }

    /**
     *  Function
     */

    public static function updateCart($ID, $data)
    {
        return self::where('ID', $ID)->update($data);
    }

}
