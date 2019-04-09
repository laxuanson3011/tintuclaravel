<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\LoaiTin;
use App\Slide;
use App\TinTuc;
use App\User;


class PagesController extends Controller
{

    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        view()->share(compact('theloai'));
        
        view()->share(compact('slide'));
    }
    function trangchu()
    {
        return view('pages.trangchu');
    }
    function lienhe()
    { 
        return view('pages.lienhe');
    }
    function gioithieu()
    {
        return view('pages.gioithieu');
    }
    function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);

        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan,]);
    }
    public function getDangky()
    {
        return view('pages.dangky');
    }
    public function postDangky(Request $request)
    {
        $this->validate($request,
            [
                 'name' => 'required|min:3|unique:users,name',
                 'email' => 'required|email|unique:users,email',
                 'password' => 'required|min:3|max:32',
                 'passwordAgain' => 'required|same:password' 
            ],
            [
                'name.required' => 'Bạn Chưa Nhập Tên ?',
                'name.min' => 'Tên Người Dùng Phải có Tối Thiểu 3 ký Tự !',
                'name.unique' => ' Tên Người Dùng Đã Tồn Tại !',
                'email.email' => 'Bạn Chưa Nhập Đúng Định Dạng Email ?',
                'email.required' => 'Bạn Chưa Nhập Email ?',
                'email.unique' => 'Email Đã Tồn Tại !',
                'password.required' => 'Bạn Chưa Nhập Password ?',
                'password.min' => 'Password Phải Có Tối Thiểu 3 Ký Tự !',
                'password.max' => 'Password Phải Có Tối Đa 32 Ký Tự !',
                'passwordAgain.required' => 'Bạn Chưa Nhập PasswordAgain ?',
                'passwordAgain.same' => 'PasswordAgain chưa khớp vói Password !',
             ]); 

             $user = new User;
             $user->name = $request->name;
             $user->email = $request->email;
             $user->password = bcrypt($request->password);
             $user->quyen = 0;
            if($request->hasFile('Hinh'))
            {
                $file = $request->file('Hinh'); 
                $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return redirect('admin/user/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); // đưa về trang thêm và thông báo được truyền qua biến loi ở trang them 
                }
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/user/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/user",$Hinh);
                $user->Hinh = $Hinh;
            }
            else
            {
                $user->Hinh = "";
            }
            $user->save();

            return redirect('pages/dangky')->with('thongbao','Đăng Ký Tài Khoản Thành Công !!!');
    }
    public function getDangnhap()
    {
        return view('pages.dangnhap');
    }
    public function postDangnhap(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:3|max:32',
            ],
            [    
                'email.email' => 'Bạn Chưa Nhập Đúng Định Dạng Email ?',
                'email.required' => 'Bạn Chưa Nhập Email ?',
                'password.required' => 'Bạn Chưa Nhập Password ?',
                'password.min' => 'Password Phải Có Tối Thiểu 3 Ký Tự !',
                'password.max' => 'Password Phải Có Tối Đa 32 Ký Tự !',
             ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) 
        {
            return redirect('pages/dangnhap')->with('thongbaodangnhap','Bạn Đã Đăng Nhập Thành Công !!!');
        }
        else {
            return redirect('pages/dangnhap')->with('loi','Bạn Đã Đăng Nhập Thất Bại Vui Lòng Đăng Nhập Lại ???');
        }
    }
    public function getTaikhoan($id)
    {
        $user = User::find($id);
        return view('pages.taikhoan',['user'=>$user]);
    }
    public function postTaikhoan(Request $request,$id) 
    {
        $this->validate($request,
        [ 
            'name' => 'required|min:3|unique:users,name',
        ],
         [
            'name.required' => 'Bạn Chưa Nhập Tên ?',
            'name.min' => 'Tên Người Dùng Phải có Tối Thiểu 3 ký Tự !',
            'name.unique' => ' Tên Người Dùng Đã Tồn Tại !',
        ]); 
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email; 
        if ($request->changePassword == "on")
        {
            $this->validate($request,
            [
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],
            [
                'password.required' => 'Bạn Chưa Nhập Password ?',
                'password.min' => 'Password Phải Có Tối Thiểu 3 Ký Tự !',
                'password.max' => 'Password Phải Có Tối Đa 32 Ký Tự !',
                'passwordAgain.required' => 'Bạn Chưa Nhập PasswordAgain ?',
                'passwordAgain.same' => 'PasswordAgain chưa khớp vói Password !',
            ]); 
        }
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return redirect('admin/user/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); // đưa về trang thêm và thông báo được truyền qua biến loi ở trang them 
                }
                $name = $file->getClientOriginalName();
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/user/".$Hinh))
                {
                    $Hinh = str_random(4)."_". $name;
                }
                $file->move("upload/user",$Hinh);
                unlink("upload/user/".$user->Hinh);
                $user->Hinh = $Hinh;
            }
        $user->save();
        return redirect('pages/taikhoan/'.$id)->with('thongbao','Sửa Tài Khoản Thành Công !!!');
    }
    public function getDangxuat()
    {
        Auth::logout();
        return redirect('pages/trangchu');
    }
    public function getDangtin()
    {   
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('pages.dangtin',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function postDangTin(Request $request)
    {
        $this->validate($request,
            [
                'LoaiTin' => 'required',
                'TieuDe' => 'required|unique:tintuc,TieuDe|min:3|max:100',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],
            [
                'TieuDe.required'=>'Bạn Chưa Nhập Tên loại tin ???',
                'TieuDe.unique'=>'Tiêu Đề Tin Tức Đã Tồn Tại !!!',
                'TieuDe.min'=>'Tiêu Đề Tin Tức Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
                'TieuDe.max'=>'Tiêu Đề Tin Tức Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
                'LoaiTin.required'=>'Bạn Chưa Chọn Loại Tin ???',
                'TomTat.required'=>'Bạn Chưa Nhập Tóm Tắt ???',
                'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung ???',
            ]);  
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe; 
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/tintuc/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); 
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_". $name;
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh = str_random(4)."_". $name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }
        $tintuc->idUser = Auth::user()->id;
        $tintuc->save();
        return redirect('pages/dangtin')->with('thongbao','Thêm Tin tức Thành Công !!!');
    }
}