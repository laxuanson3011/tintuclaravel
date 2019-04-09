<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    // khai bao table co trong database

    protected $table = "theloai";

    // tao lien ket gia cac model voi nhau 
    // model thể loại với loại tin 
    // hàm loai tin : để liên kết tới table Loại tin
    // chức năng của ham loai tin là lấy tât cả cac laoi tin có trong the loai thông qua liên kết 

    public function loaitin()
    {
        // trong 1 thể loại có bao nhiêu loại tin 
        // có những loại tin gì
        // 1 thể loại có nhiều loại tin nên dùng hasMany('App/LoaiTin trỏ đến model loại tin','idTheLoai khóa phụ','id khóa chinh');
        return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }

    // hàm tin tức : để liên kết tới table tin tức
    // model thể loại với tin tức
    // chức năng của hàm tin tức là lây tất cả các tin tưc có trong thể loại 
    
    public function tintuc()
    {
        // trong 1 thể loại có bao nhiêu tin tức và đó là những tin tưc gì 
        // 1 thể loai có nhiều tin tức,  tin tưc liên kết thong qua loại tin liên kêt thể loại nen dùng hasManyThrough()
        return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
