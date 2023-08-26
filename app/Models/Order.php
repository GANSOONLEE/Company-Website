<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $incrementing = false;
    protected $primaryKey = 'order_id';
    protected $guarded = [ ];
    public $timestamps = true;
    public $fillable = [
        'order_id',
        'user_id',
        'email_address',
        'order_received_date',
        'order_received_time',
        'order_content',
        'order_status', // Enum: New, Pending, Processing, On Hold, Completed
    ];

    /**
     * One order only belongs to one user
     */

    public function user()
    {
        return $this->belongsTo(User::class, 'email_address', 'email_address');
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
