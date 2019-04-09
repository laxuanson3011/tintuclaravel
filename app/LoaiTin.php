<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    // khai bao table co trong database

    protected $table = "loaitin";

    // tạo liên ket giữa model loại tin với thể loại  
    // hàm thể loại : loại tim thuộc thể loại nào 
    public function theloai()
    {
        // 1 loại tin thuộc 1 thể loại nên dùng belongsTo()
        return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    // tạo liên ket giữa model loại tin với tin tức
    // hàm tin tức : trong 1 loại tin có bao nhiêu tin 

    public function tintuc()
    {
        // 1 loại tin có nhiều tin tức nên dùng hasMany
        return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
