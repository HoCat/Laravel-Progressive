<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nickname', 'education', 'origin', 'idcard', 'birthday', 'signature', 'speciatly', 'phone', 'email', 'qq', 'wechat', 'address', 'password', 'avatar', 'last_token', 'status', 'last_login_time', 'last_login_ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
    /**
     * 指定模型关联表名
     * Specify model association table name
     *
     * @var string
     */
     protected  $table = 'user';

     public function tasks()
     {
         return $this->hasMany(Task::class);
     }
}
