<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;


class SlideController extends Controller
{
    public function getDanhSach()
    {
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getThem()
    {
        return view('admin.slide.them');
    }
    public function postThem(Request $request)
    {
        $this->validate($request,
        [
            'Ten' => 'required|unique:slide,Ten|min:2|max:100',
            'NoiDung' => 'required',
        ],
        [
            'Ten.required'=>'Bạn Chưa Nhập Tên slide ???',
            'Ten.unique'=>'Tên slde Đã Tồn Tại !!!',
            'Ten.min'=>'Tên slide Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
            'Ten.max'=>'Tên slide Phải Có Độ Dài Từ 3 Đến 100 Ký Tự',
            'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung ???',
        ]);  
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if ($request->has('link')) 
            $slide->link = $request->link;
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_". $name;
            while(file_exists("upload/slide/".$Hinh)) 
            {
                $Hinh = str_random(4)."_". $name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh = $Hinh;
        }
        else
        {
            $slide->Hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm slide Thành Công !!!');
    }
    public function getSua($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }
    public function postSua(Request $request,$id)
    {
        $slide = Slide::find($id);
        $this->validate($request,
        [
            'Ten' => 'required|min:2|max:100',           
            'NoiDung' => 'required',
        ],
        [
            'Ten.required'=>'Bạn Chưa Nhập Tên slide ???',
            'Ten.min'=>'Tên slide Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
            'Ten.max'=>'Tên slide Phải Có Độ Dài Từ 3 Đến 100 Ký Tự',
            'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung ???',
        ]);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if ($request->has('link'))
            $slide->link = $request->link;
        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???');
            }
            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_". $name;
            while(file_exists("upload/slide/".$Hinh)) 
            {
                $Hinh = str_random(4)."_". $name;
            }
            $file->move("upload/slide",$Hinh);
                unlink("upload/slide/".$slide->Hinh);
                $slide->Hinh = $Hinh;
            }
            $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa Slide Thành Công !!!');
    }
    public function getXoa($id)
    {
        $slide = Slide::find($id);
        $slide->delete(); //xóa
        return redirect('admin/slide/danhsach')->with('thongbao','Bạn Đã Xóa slide Thành Công !!!');
    }
}
