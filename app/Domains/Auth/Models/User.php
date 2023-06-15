<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Domains\Auth\Models\Role;

class User extends Authenticatable{
    
    use HasApiTokens, HasFactory, Notifiable;

    // 用戶只能屬於一個身分組
    public function role(){
        return $this->belongsTo(Role::class, 'userRole');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name', // 使用者名稱
        'Phone Number', // 電話號碼
        'Email', // 電子郵件
        'Birthday', // 生日日期
        'Address', // 地址: 完整地區
        'Profession', // 職業
        'Store/Company Name', // 店名/公司名
        'Role', // 身分組
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Id', // 數據庫内部編號
        'Password', // 密碼
        'AccessToken', // 訪問令牌
        'created_at', // 創建時間
        'updated_at', // 更新時間
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
