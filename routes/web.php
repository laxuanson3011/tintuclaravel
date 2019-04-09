<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// khai bao thu vien

use App\TheLoai;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route cua model

Route::get('thu',function(){
    $theloai = TheLoai::find(1); // lay theo idtheloai co trong loai tin = 1
    //echo $theloai->Ten."<br>";
    
    // lay het tat ca loai tin co trong the loai
    foreach($theloai->loaitin as $loaitin)
    {
        echo $loaitin->Ten."<br>";
    }
    
});

//route thử file .blade.php của admin

Route::get('thublade',function(){
    return view('admin/tintuc/them');
});

//route login

//route get login   
Route::get('admin/login','UserController@getLogin')->name('login');
//route post login
Route::post('admin/login','UserController@postLogin');

//route logout

//route get logout
Route::get('admin/logout','UserController@getLogout')->name('logout');

//tạo group route cho admin 

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

    //tạo group route cho thể loại
    Route::group(['prefix'=>'theloai'],function(){

        //route danh sách
        Route::get('danhsach','TheLoaiController@getDanhSach')->name('theloai.danhsach');

        //route sửa get 
        Route::get('sua/{id}','TheLoaiController@getSua')->name('theloai.sua');//truyền vào id để biết sữa thể loại nào 
        //route sửa post
        Route::post('sua/{id}','TheLoaiController@postSua');

        //route thêm get
        Route::get('them','TheLoaiController@getThem')->name('theloai.them');
        //route thêm post
        Route::post('them','TheLoaiController@postThem');

        //route xóa get
        Route::get('xoa/{id}','TheLoaiController@getXoa')->name('theloai.xoa');
        
    });

    //tạo group route cho loại tin
    Route::group(['prefix'=>'loaitin'],function(){       
        
        
        //route danh sách
        Route::get('danhsach','LoaiTinController@getDanhSach')->name('loaitin.danhsach');

        //route sửa get 
        Route::get('sua/{id}','LoaiTinController@getSua')->name('loaitin.sua');//truyền vào id để biết sữa loại tin nào 
        //route sửa post
        Route::post('sua/{id}','LoaiTinController@postSua');

        //route thêm get
        Route::get('them','LoaiTinController@getThem')->name('loaitin.them');
        //route thêm post
        Route::post('them','LoaiTinController@postThem');

        //route xóa get
        Route::get('xoa/{id}','LoaiTinController@getXoa')->name('loaitin.xoa');

    });

    //tạo group route cho tin tức
    Route::group(['prefix'=>'tintuc'],function(){

        //route danh sách
        Route::get('danhsach','TinTucController@getDanhSach')->name('tintuc.danhsach');

        //route sửa get 
        Route::get('sua/{id}','TinTucController@getSua')->name('tintuc.sua');//truyền vào id để biết sữa thể loại nào 
        //route sửa post
        Route::post('sua/{id}','TinTucController@postSua');

        //route thêm get
        Route::get('them','TinTucController@getThem')->name('tintuc.them');
        //route thêm post
        Route::post('them','TinTucController@postThem');

        //route xóa get
        Route::get('xoa/{id}','TinTucController@getXoa')->name('tintuc.xoa');

    });

    //tạo group route cho comment
    Route::group(['prefix'=>'comment'],function(){

        //route xóa get
        Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa')->name('comment.xoa');
    });

    //tạo group route cho slide
    Route::group(['prefix'=>'slide'],function(){
                
        //route danh sách
        Route::get('danhsach','SlideController@getDanhSach')->name('slide.danhsach');

        //route sửa get 
        Route::get('sua/{id}','SlideController@getSua')->name('slide.sua');//truyền vào id để biết sữa thể loại nào 
        //route sửa post
        Route::post('sua/{id}','SlideController@postSua');

        //route thêm get
        Route::get('them','SlideController@getThem')->name('slide.them');
        //route thêm post
        Route::post('them','SlideController@postThem');

        //route xóa get
        Route::get('xoa/{id}','SlideController@getXoa')->name('slide.xoa');

   });


    //tạo group route cho user
    Route::group(['prefix'=>'user'],function(){
        

        //route danh sách
        Route::get('danhsach','UserController@getDanhSach')->name('user.danhsach');

        //route sửa get 
        Route::get('sua/{id}','UserController@getSua')->name('user.sua');//truyền vào id để biết sữa thể loại nào 
        //route sửa post
        Route::post('sua/{id}','UserController@postSua');

        //route thêm get
        Route::get('them','UserController@getThem')->name('user.them');
        //route thêm post
        Route::post('them','UserController@postThem');

        //route xóa get
        Route::get('xoa/{id}','UserController@getXoa')->name('user.xoa');

    });

    // tạo group route cho ajax
    Route::group(['prefix'=>'ajax'],function(){

        //route get loai tin
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });

   
});

//route thử trang chủ
Route::get('trangchu', function () {
    return view('pages.trangchu');
});

// tao group route page 
Route::group(['prefix' => 'pages'], function () {

    //route trangchu
    Route::get('trangchu','PagesController@trangchu')->name('pages.trangchu');

    //route lienhe
    Route::get('lienhe','PagesController@lienhe')->name('pages.lienhe');

    //route gioithieu
    Route::get('gioithieu','PagesController@gioithieu')->name('pages.gioithieu');

    //route loaitin
    Route::get('loaitin/{id}/{TenKhongDau}','PagesController@loaitin')->name('pages.loaitin');

    //route tintuc
    Route::get('tintuc/{id}/{TieuDeKhongDau}','PagesController@tintuc')->name('pages.tintuc');
    
    //route get dang ky 
    Route::get('dangky','PagesController@getDangky')->name('pages.dangky');
    //route post dangky 
    Route::post('dangky','PagesController@postDangky');

    //route get dang nhap 
    Route::get('dangnhap','PagesController@getDangnhap')->name('pages.dangnhap');
    //route post dangnhap 
    Route::post('dangnhap','PagesController@postDangnhap');

    //route get tai khoan 
    Route::get('taikhoan/{id}','PagesController@getTaikhoan')->name('pages.taikhoan');
    //route post taikhoan 
    Route::post('taikhoan/{id}','PagesController@postTaikhoan');

    //route get dangxuat
    Route::get('dangxuat','PagesController@getDangxuat')->name('pages.dangxuat');

    Route::post('comment/{id}','CommentController@postComment');

    Route::get('dangtin','PagesController@getDangtin')->name('pages.dangtin');
    //route post dangtin 
    Route::post('dangtin','PagesController@postDangtin');

    // tạo group route cho ajax
    Route::group(['prefix'=>'ajax'],function(){

        //route get loai tin
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });
    
});

