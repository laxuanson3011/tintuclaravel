<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    // khai bao table co trong database

    protected $table = "tintuc";

    // tạo liên ket giữa model tin tức với loại tin 
    // hàm loại tin : tin tức đó thuộc loại tin nào

    public function loaitin()
    {
        // 1 tin tức thuộc 1 loại tin nên dùng belongsto()
        return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }

    // tạo liên ket giữa model tin tức với comment 
    // hàm comment : cho chúng ta lấy ra các comment của nó 
    
    public function comment()
    {   // trong 1 tin tức có  bao nhiêu comment 
        // 1 tin tức có nhiều comment nên dùng hasMany()
        return $this->hasMany('App\Comment','idTinTuc','id');
    }

    
    // tạo liên ket giữa model tin tức với user 
    // hàm user : cho chúng ta lấy ra các user của nó 
    
    public function user()
    {   // trong 1 tin tức có bao nhiêu user 
        // 1 tin thuộc 1 user và 1 user có thể đăng nhiều  tin  nên dùng belongsTo()
        return $this->belongsTo('App\User','idUser','id');
    }
}
