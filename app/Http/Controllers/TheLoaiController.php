<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }
    public function getThem()
    {
        return view('admin.theloai.them');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'Ten' => 'required|unique:theloai,Ten|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn Chưa Nhập Tên Thể Loại ???',
                'Ten.unique'=>'Tên Thể Loại Đã Tồn Tại !!!',
                'Ten.min'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
                'Ten.max'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Đến 100 Ký Tự'
            ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm Thể Loại Thành Công !!!');
    }
    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id) //$id la để tìm đến thể loại cần sữa 
    {
        $theloai = TheLoai::find($id);//lấy thể loại cần sửa ra
        //kiểm tra lỗi 
        $this->validate($request,
        // truyen vao 2 tham so mang
            [
                // tham so 1 la lỗi
                'Ten' => 'required|unique:theloai,Ten|min:3|max:100' // required điều kiện nhập, unique điều kiện trùng lặp :bảng bị trùng ,cột bị trùng , 
            ],
            [
                // tham số 2 là thông báo
                'Ten.required'=>'Bạn Chưa Nhập Tên Thể Loại ???',
                'Ten.unique'=>'Tên Thể Loại Đã Tồn Tại !!!',
                'Ten.min'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Đến 100 Ký Tự',
                'Ten.max'=>'Tên Thể Loại Phải Có Độ Dài Từ 3 Đến 100 Ký Tự'
            ]); 
        // sửa tên thể loại 
        $theloai->Ten = $request->Ten; // tên thể loại củ = tên thể loại mới 
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa Thể Loại Thành Công !!!');// đưa data về lại trang sửa và thông báo 
    }

    //hàm getXoa để trỏ qua route xóa nhận lại id xóa

    public function getXoa($id)
    {
        // truyến vào và tim id = id truyen vào  model Thẻ loại tim id dung find()
        $theloai = TheLoai::find($id);
        $theloai->delete(); //xóa

        // trở lại trang danh sách và thông báo
        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn Đã Xóa Thành Công !!!');
    }
}
