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

    protected $table = 'carts';
    protected $primaryKey = 'cart_ID';
    protected $fillable = [
        'email_address',
        'cart_content',
    ];
    public $timestamps = false;

    /**
     * @example
     * {
     *     "product_code" : "12343543ASD",
     *     "product_category": "Fan Control",
     *     "cart_content": [
     *         {
     *             "brand": "SWJ",
     *             "brand_code": "SWJ-001",
     *             "quantity": 4
     *         },
     *         {
     *             "brand": "AM",
     *             "brand_code": "AM-001",
     *             "quantity": 2
     *         }
     *     ]
     * }
     */
    
    protected $casts = [
        'cart_content' => 'json',
    ];

    /**
     *  Relationship
     */

    public function user(){
        return $this->hasOne(User::class, 'email_address', 'email_address');
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id', 'productID');
    // }

    // public function cart_to_product()
    // {
    //     return $this->product()->first(); // 返回关联的User模型
    // }

    /**
     *  Function
     */

    public static function updateCart($ID, $data)
    {
        return self::where('ID', $ID)->update($data);
    }

}
