<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    public $incrementing = false;
    protected $primaryKey = 'orderID';
    protected $guarded = [ ];
    public $timestamps = true;
    public $fillable = [
        'orderID',
        'Email', // user.email
        'orderReceivedDate',
        'orderReceivedTime',
        'orderContent', // json
        'orderStatus', // Enum: New, Received, In Process, Complete
    ];

    /**
     * One order only belongs to one user
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'Email', 'Email');
    }

    public function order_to_user()
    {
        return $this->user()->first(); // 返回关联的User模型
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'ID', 'ID');
    }

    public function order_to_cart()
    {
        return $this->cart()->first(); // 返回关联的User模型
    }
}
