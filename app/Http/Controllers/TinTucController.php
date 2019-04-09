<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;



class TinTucController extends Controller
{
    //hàm getDanhSach để trỏ  qua route danh sách 

    public function getDanhSach()
    {
        // hiện thị tăt cả danh sách tin tức được sắp xếp có trong model tin tức dùng hàm orderby();
        $tintuc = TinTuc::orderBy('id','DESC')->get();// theo id, giảm dần
        // truyền danh sách mới lấy ra qua trang danh sách để hiện thị , phải truyền tham số vào trong view bằng 1 mảng 
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    //hàm getThem để trỏ  qua route thêm

    public function getThem()
    {
        //truyền tên thể loại vào tin tuc
        $theloai = TheLoai::all();
        //truyền ten loại tin
        $loaitin = LoaiTin::all();
        //hiện thị trang thêm tin tức
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
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
                      // bien theloai truyen tu name trong them.blade.php
                     'LoaiTin' => 'required', //bien loaitin truyen tu name trong them.blade.php
                     'TieuDe' => 'required|unique:tintuc,TieuDe|min:3|max:100', //required điều kiên nhập, unique điều kiện trùng lặp :bảng bị trùng ,cột bị trùng , min số ký tự tối thiểu , max số ký tự tối đa
                     'TomTat' => 'required', //bien tintuc truyen tu name trong them.blade.php
                     'NoiDung' => 'required', //bien tintuc truyen tu name trong them.blade.php
                 ],
                 [
                     // tham số 2 là thông báo
                     'TieuDe.required'=>'Bạn Chưa Nhập Tên loại tin ???',
                     'TieuDe.unique'=>'Tiêu Đề Tin Tức Đã Tồn Tại !!!',
                     'TieuDe.min'=>'Tiêu Đề Tin Tức Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
                     'TieuDe.max'=>'Tiêu Đề Tin Tức Phải Có Độ Dài Từ 3 Đến 100 Ký Tự',
                     
                     'LoaiTin.required'=>'Bạn Chưa Chọn Loại Tin ???',
                     'TomTat.required'=>'Bạn Chưa Nhập Tóm Tắt ???',
                     'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung ???',
                 ]);  
    
            // lấy dữ liệu của Tên vừa thêm để lưu vào trong model TinTuc
            $tintuc = new TinTuc;
            $tintuc->TieuDe = $request->TieuDe;// gắn tên mới 
            $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
            // echo changeTitle($request->Ten);
            
            $tintuc->idLoaiTin = $request->LoaiTin;
            $tintuc->NoiDung = $request->NoiDung;
            $tintuc->TomTat = $request->TomTat;
            $tintuc->NoiBat = $request->NoiBat;
            $tintuc->SoLuotXem = 0;
            $tintuc->idUser = Auth::user()->id;

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
                    return redirect('admin/tintuc/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); // đưa về trang thêm và thông báo được truyền qua biến loi ở trang them 
                }
                // kiểm tra tên hình đã tồn tại hay chua 
                $name = $file->getClientOriginalName();
                //sau khi lấy tên hình ra phải đặt tên làm sao cho nó không trùng với tên củ của hình
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/tintuc/".$Hinh)) // file_exists để kiểm trả file có tồn tại hay không 
                {
                    $Hinh = str_random(4)."_". $name;
                }
                // sau khi lấy tên hình xong dùng hàn move(đường dẫn tới chổ lưu hình, tên hình) để save hình đó
                $file->move("upload/tintuc",$Hinh);
                //echo $Hinh; //hiện thị ra tên hình
                $tintuc->Hinh = $Hinh;
            }
            else
            {
                $tintuc->Hinh = "";
            }

            $tintuc->save();//lưu tin tức mới thêm vào 
            
            return redirect('admin/tintuc/them')->with('thongbao','Thêm Tin tức Thành Công !!!'); // đưa về trang thêm và thông báo được truyền qua biến thongbao o trang them
        }

    //hàm getSua để trỏ qua route sửa nhận lại id sửa

    public function getSua($id)
    {
        //lấy danh sách các camment của 1 tin tức truyền qua trang sửa tin tưc
        // trong comment có liên kết với tin tức 

        //truyền tên thể loại vào tin tuc để sửa thể loại
        $theloai = TheLoai::all();
        //truyền ten loại tin để sủa loại tin váo cập nhật lên data
        $loaitin = LoaiTin::all();
        // truyến vào và tim id = id truyen vào  model Thẻ loại tim id dung find()
        $tintuc = TinTuc::find($id);
        // truyến qua trang sửa để hiện thị 
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    //hàm postSua để lấy dữ liệu sửa và sau đó lưu vào database

    public function postSua(Request $request,$id) //$id la để tìm đến thể loại cần sữa 
    {
        $tintuc = TinTuc::find($id);//lấy tin tức cần sửa ra
        //kiểm tra lỗi 
         // kiem tra truyen du lieu qua 2 bien dung validate de ckeck dieu kien cua 2 bien do
         $this->validate($request,
         // truyen vao 2 tham so mang
              [
                  // tham so 1 la lỗi
                   // bien theloai truyen tu name trong them.blade.php
                  'LoaiTin' => 'required', //bien loaitin truyen tu name trong them.blade.php
                  'TieuDe' => 'required|unique:tintuc,TieuDe|min:3|max:100', //required điều kiên nhập, unique điều kiện trùng lặp :bảng bị trùng ,cột bị trùng , min số ký tự tối thiểu , max số ký tự tối đa
                  'TomTat' => 'required', //bien tintuc truyen tu name trong them.blade.php
                  'NoiDung' => 'required', //bien tintuc truyen tu name trong them.blade.php
              ],
              [
                  // tham số 2 là thông báo
                  'TieuDe.required'=>'Bạn Chưa Nhập Tên loại tin ???',
                  'TieuDe.unique'=>'Tiêu đề Đã Tồn Tại !!!',
                  'TieuDe.min'=>'Tiêu đề Phải Có Độ Dài Từ 3 Đến 100 Ký Tự', 
                  'TieuDe.max'=>'Tiêu đề Phải Có Độ Dài Từ 3 Đến 100 Ký Tự',
                  
                  'LoaiTin.required'=>'Bạn Chưa Chọn Loại Tin ???',
                  'TomTat.required'=>'Bạn Chưa Nhập Tóm Tắt ???',
                  'NoiDung.required'=>'Bạn Chưa Nhập Nội Dung ???',
              ]);   
        // sửa tên thể loại 
        $tintuc->TieuDe = $request->TieuDe;// gắn tên mới 
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        // echo changeTitle($request->Ten);
        
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiBat = $request->NoiBat;
        
        // sửa ảnh 
        if($request->hasFile('Hinh'))
            {
                //gán hình vào biến file
                $file = $request->file('Hinh');
                //kiểm trả định dạng đuôi của 
                $duoi = $file->getClientOriginalExtension();
                if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
                {
                    return redirect('admin/tintuc/them')->with('loi','chỉ chọn được hình ảnh có đuôi là "jpg" "png" "jpeg" ???'); // đưa về trang thêm và thông báo được truyền qua biến loi ở trang them 
                }
                // kiểm tra tên hình đã tồn tại hay chua 
                $name = $file->getClientOriginalName();
                //sau khi lấy tên hình ra phải đặt tên làm sao cho nó không trùng với tên củ của hình
                $Hinh = str_random(4)."_". $name;
                while(file_exists("upload/tintuc/".$Hinh)) // file_exists để kiểm trả file có tồn tại hay không 
                {
                    $Hinh = str_random(4)."_". $name;
                }
                
                // sau khi lấy tên hình xong dùng hàn move(đường dẫn tới chổ lưu hình, tên hình) để save hình đó
                $file->move("upload/tintuc",$Hinh);
                // xóa file củ đi trước khi lưu file mới vào data
                unlink("upload/tintuc/".$tintuc->Hinh);//unlink("đường dẫn tới file cần xóa".biến->tên file cần xóa )
                //echo $Hinh; //hiện thị ra tên hình
                $tintuc->Hinh = $Hinh;
            }
            // khong mương sua hình 


            $tintuc->save();//lưu tin tức mới sửa


        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa Tin Túc Thành Công !!!');// đưa data về lại trang sửa và thông báo 
    }

    //hàm getXoa để trỏ qua route xóa nhận lại id xóa

    public function getXoa($id)
    {
        // truyến vào và tim id = id truyen vào  model Tin Tức tim id dung find()
        $tintuc = TinTuc::find($id);
        $tintuc->delete(); //xóa

        // trở lại trang danh sách và thông báo
        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn Đã Xóa Tin Thành Công !!!');
    }
}
