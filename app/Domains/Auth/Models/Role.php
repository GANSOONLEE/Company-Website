<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Domains\Auth\Models\User;

class Role extends Model{

    // 啓用可通知和工廠模式
    use HasFactory, Notifiable;

    /**
     * The attributes that can be displayed for serialization.
     * 
     * @var string(roleName);
     * @var string(rolePermission);
     * 
     */
    protected $fillable = [
        'roleName',
        'rolePermission',
    ];

    // 一個身分組可以有多個用戶
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     *  @var
     * 
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'roleName',
        'rolePermissionBitmask',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
