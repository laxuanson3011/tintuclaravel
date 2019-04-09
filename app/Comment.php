<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // khai bao table co trong database

    protected $table = "comment";

    // tạo liên ket giữa model comment với tin tức 
    // hàm tin tức : comment thuộc tin tức nào

    public function tintuc()
    {
        // 1 comment thuộc 1 cái tin tức nên dùng belongsTo()
       return $this->belongsTo('App\TinTuc','idTinTuc','id');
    }
    // tạo liên ket giữa model comment với user
    // HÀM USER : comment thuộc user nào 

    public function user()
    {
        // 1 comment thuộc 1 user và 1 user có nhiều comment nên dùng belongsTo()
        return $this->belongsTo('App\User','idUser','id');
    }
}
