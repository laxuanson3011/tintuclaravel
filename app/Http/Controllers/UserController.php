<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    //hàm getDanhSach để trỏ  qua route danh sách 

    public function getDanhSach()
    {
        // hiện thị tăt cả danh sách có trong model user dùng hàm all();
        $user = User::all();
        // truyền danh sách mới lấy ra qua trang danh sách để hiện thị , phải truyền tham số vào trong view bằng 1 mảng 
        return view('admin.user.danhsach',['user'=>$user]);
    }

    //hàm getThem để trỏ  qua route thêm

    public function getThem()
    {
        return view('admin.user.them');
    }

    // hàm postThem để nhận dữ liệu về và lưu vào database

    public function postThem(Request $request) // truyền request để nhận dữ liệu
    {
        //echo $request->Ten;

        // kiem tra truyen du lieu qua 2 bien dung validate de ckeck dieu kien cua 2 bien do
        $this->validate($request,
        // truyen vao 2 tham so mang
             [
                 // tham so 1 la lỗi
                  // bien user truyen tu name trong them.blade.php
                 'name' => 'required|min:3|unique:users,name',
                 'email' => 'required|email|unique:users,email',//email kiem tra dinh dang dia chi Email
                 'password' => 'required|min:3|max:32',
                 'passwordAgain' => 'required|same:password'// same kiem tra pass nhap lai co trung voi passwors 

             ],
             [
                 // tham số 2 là thông báo
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
             $user->password = bcrypt($request->password);//mã Hóa Mật khẩu bcrypt
             $user->quyen = $request->quyen;

              // kiểm tra có truyền hình ảnh len không 
            //nếu có thì save truong Hình anh vào database
            //nếu khong thì rổng 
            //hasfile  là kiem tra file hinh ảnh
            if($request->hasFile('Hinh'))
            {
                //gán hình vào biến file
                $file = $request->file('Hinh');
                //kiểm trả định dạng đuôi của 
                $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return redirect('admin/user/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); // đưa về trang thêm và thông báo được truyền qua biến loi ở trang them 
                }
                // kiểm tra tên hình đã tồn tại hay chua 
                $name = $file->getClientOriginalName();
                //sau khi lấy tên hình ra phải đặt tên làm sao cho nó không trùng với tên củ của hình
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/user/".$Hinh)) // file_exists để kiểm trả file có tồn tại hay không 
                {
                    $Hinh = str_random(4)."_". $name;
                }
                // sau khi lấy tên hình xong dùng hàn move(đường dẫn tới chổ lưu hình, tên hình) để save hình đó
                $file->move("upload/user",$Hinh);
                //echo $Hinh; //hiện thị ra tên hình
                $user->Hinh = $Hinh;
            }
            else
            {
                $user->Hinh = "";
            }

             $user->save();

             return redirect('admin/user/them')->with('thongbao','Thêm Người Dùng Thành Công !!!');
    }
    //hàm getSua để trỏ  qua route sửa 

    public function getSua($id)
    {
        // truyến vào và tim id = id truyen vào  model user tim id dung find()
        $user = User::find($id);
        // truyến qua trang sửa để hiện thị 
        return view('admin.user.sua',['user'=>$user]);
    }

    //hàm postSua để lấy dữ liệu sửa và sau đó lưu vào database

    public function postSua(Request $request,$id) //$id la để tìm đến User cần sữa 
    {
        
        //kiểm tra lỗi 
        $this->validate($request,
        // truyen vao 2 tham so mang
        [
            // tham so 1 la lỗi
             // bien user truyen tu name trong sua.blade.php
            'name' => 'required|min:3|unique:users,name',
           

        ],
        [
            // tham số 2 là thông báo
           'name.required' => 'Bạn Chưa Nhập Tên ?',
           'name.min' => 'Tên Người Dùng Phải có Tối Thiểu 3 ký Tự !',
           'name.unique' => ' Tên Người Dùng Đã Tồn Tại !',
           
          
        ]); 

        $user = User::find($id);//lấy User cần sửa ra
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->changePassword == "on") {
            //kiểm tra lỗi 
            $this->validate($request,
            // truyen vao 2 tham so mang
            [
                // tham so 1 la lỗi
                // bien user truyen tu name trong sua.blade.php
                
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'// same kiem tra pass nhap lai co trung voi passwors 

            ],
            [
                // tham số 2 là thông báo
            'password.required' => 'Bạn Chưa Nhập Password ?',
            'password.min' => 'Password Phải Có Tối Thiểu 3 Ký Tự !',
            'password.max' => 'Password Phải Có Tối Đa 32 Ký Tự !',
            'passwordAgain.required' => 'Bạn Chưa Nhập PasswordAgain ?',
            'passwordAgain.same' => 'PasswordAgain chưa khớp vói Password !',
            ]); 
        }

        $user->password = bcrypt($request->password);//mã Hóa Mật khẩu bcrypt
        $user->quyen = $request->quyen;

        // sửa ảnh 
       // kiểm tra có truyền hình ảnh len không 
            //nếu có thì save truong Hình anh vào database
            //nếu khong thì rổng 
            //hasfile  là kiem tra file hinh ảnh
            if($request->hasFile('Hinh'))
            {
                //gán hình vào biến file
                $file = $request->file('Hinh');
                //kiểm trả định dạng đuôi của 
                $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return redirect('admin/user/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); // đưa về trang thêm và thông báo được truyền qua biến loi ở trang them 
                }
                // kiểm tra tên hình đã tồn tại hay chua 
                $name = $file->getClientOriginalName();
                //sau khi lấy tên hình ra phải đặt tên làm sao cho nó không trùng với tên củ của hình
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/user/".$Hinh)) // file_exists để kiểm trả file có tồn tại hay không 
                {
                    $Hinh = str_random(4)."_". $name;
                }
                
                // sau khi lấy tên hình xong dùng hàn move(đường dẫn tới chổ lưu hình, tên hình) để save hình đó
                $file->move("upload/user",$Hinh);
                // xóa file củ đi trước khi lưu file mới vào data
                unlink("upload/user/".$user->Hinh);//unlink("đường dẫn tới file cần xóa".biến->tên file cần xóa )
                //echo $Hinh; //hiện thị ra tên hình
                $user->Hinh = $Hinh;
            }

        $user->save();


        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa User Thành Công !!!');// đưa data về lại trang sửa và thông báo 
    }

    //hàm getXoa để trỏ qua route xóa nhận lại id xóa

    public function getXoa($id)
    {
        // truyến vào và tim id = id truyen vào  model user tim id dung find()
        $user = User::find($id);
        $user->delete(); //xóa

        // trở lại trang danh sách và thông báo
        return redirect('admin/user/danhsach')->with('thongbao','Bạn Đã Xóa User Thành Công !!!');
    }

    //ham getLogin de tro vao route login tim den nguoi dung

    public function getLogin()
    {
        //hien thi trang login
        return view('admin.login');
    }

    // hàm postLogin để nhận dữ liệu kien tra user trong database

    public function postLogin(Request $request) // truyền request để nhận dữ liệu
    {
        //echo $request->Ten;

        // kiem tra truyen du lieu qua 2 bien dung validate de ckeck dieu kien cua 2 bien do
        $this->validate($request,
        // truyen vao 2 tham so mang
             [
                 // tham so 1 la lỗi
                  // bien login truyen tu name trong them.blade.php
                 
                 'email' => 'required|email',//email kiem tra dinh dang dia chi Email
                 'password' => 'required|min:3|max:32',
                 

             ],
             [
                 // tham số 2 là thông báo
                
                'email.email' => 'Bạn Chưa Nhập Đúng Định Dạng Email ?',
                'email.required' => 'Bạn Chưa Nhập Email ?',
                
                'password.required' => 'Bạn Chưa Nhập Password ?',
                'password.min' => 'Password Phải Có Tối Thiểu 3 Ký Tự !',
                'password.max' => 'Password Phải Có Tối Đa 32 Ký Tự !',
             ]);

        //dung ham attempt de kiem tra cai dang nhap cua nguoi dung ->with('thongbaologin','Bạn Đã Đăng Nhập Thành Công !!!')
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) 
        {
            return redirect('admin/theloai/danhsach')->with('thongbaologin','Bạn Đã Đăng Nhập Thành Công !!!');
        }
        else {
            return redirect('admin/login')->with('thongbaolg','Bạn Đã Đăng Nhập Thất Bại Vui Lòng Đăng Nhập Lại ???');
        }
    }

    // ham logout

    public function getLogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}

