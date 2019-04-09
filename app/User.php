<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // tạo liên ket giữa model user với comment
    // hàm comment : user này comment những gì và cho biết danh sách những commnent

    public function comment()
    {
        // 1 ngưới dùng có thể có nhiều comment khác nhau nên dùng hasMany()
        return $this->hasMany('App\Comment','idUser','id');
    }

    // tạo liên ket giữa model user với tintuc
    // hàm tintuc : user này dangtintuc những gì và cho biết danh sách những tintuc

    public function tintuc()
    {
        // 1 ngưới dùng có thể dang  nhiều tintuc khác nhau nên dùng hasMany()
        return $this->hasMany('App\TinTuc','idUser','id');
    }
}
