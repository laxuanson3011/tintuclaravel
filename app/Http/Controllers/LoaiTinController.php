<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    public function getThem()
    {
        $theloai =  TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
        $this->validate($request,
            [
                'Ten' => 'required|unique:loaitin,Ten|min:2|max:100',
                'TheLoai' => 'required',
            ],
            [
                'Ten.required'=>'Bạn Chưa Nhập Tên loại tin ???',
                'Ten.unique'=>'Tên Loại Tin Đã Tồn Tại !!!',
                'Ten.min'=>'Tên Thể Loại Phải Có Độ Dài Từ 2 Đến 100 Ký Tự', 
                'Ten.max'=>'Tên Thể Loại Phải Có Độ Dài Từ 2 Đến 100 Ký Tự',
                'TheLoai'=>'Bạn Chưa Chọn Thể Loại ???',
            ]);  

        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        
        return redirect('admin/loaitin/them')->with('thongbao','Thêm Loại Tin Thành Công !!!');
    }
    public function getSua($id)
    {
        $theloai =  TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }
    public function postSua(Request $request,$id) 
    {
        $loaitin = LoaiTin::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:loaitin,Ten|min:2|max:100', 
                'TheLoai' => 'required', 
            ],
            [
                'Ten.required'=>'Bạn Chưa Nhập Tên loại tin ???',
                'Ten.unique'=>'Tên Loại Tin Đã Tồn Tại !!!',
                'Ten.min'=>'Tên Loại Tin Phải Có Độ Dài Từ 2 Đến 100 Ký Tự', 
                'Ten.max'=>'Tên Loại Tin Phải Có Độ Dài Từ 2 Đến 100 Ký Tự',
                'TheLoai'=>'Bạn Chưa Chọn Thể Loại ???',
            ]);  
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa Loại Tin Thành Công !!!');// đưa data về lại trang sửa và thông báo 
    }
    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn Đã Xóa Thành Công !!!');
    }
}
