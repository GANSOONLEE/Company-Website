<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Operation extends Model{

    protected $table = 'operation';
    protected $primaryKey = 'operation_id';
    protected $fillable = [
        'email_address',
        'operation_data',
        'operation_type',
    ];

    /**
     * {
     *    "user": {
     *        "id" : "",
     *        "current_role" : "admin",
     *        "new_role" : "admin"
     *    }
     *    ,
     *    "order": {
     *        "id" : "",
     *        "current_status" : "admin",
     *        "new_status" : "admin"
     *    },
     *    "product": {
     *        "id" : ""
     *    }
     * }
     */
    
    protected $casts = [
        'operation_data' => 'json',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'email_address', 'email_address');
    }

    public function operation_to_user()
    {
        return $this->user()->first();
    }

}