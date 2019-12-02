<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    const NOT_COMPLETED = 0; // 未完成
    const COMPLETED = 1;  // 已完成

    // 指定入库字段
    public $fillable = [ 'is_completed', 'user_id', 'text'];


    /**
     *  关联 User 模型
     *  user => task
     *  一   =>  多
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
