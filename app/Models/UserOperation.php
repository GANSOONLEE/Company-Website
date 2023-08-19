<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserOperation extends Model{

    protected $table = 'users_operation';
    protected $primaryKey = 'operationID';
    protected $fillable = [
        'userID',
        'ID',
        'operationType',
    ];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'Id');
    }

    public function operation_to_user()
    {
        return $this->user()->first();
    }

}