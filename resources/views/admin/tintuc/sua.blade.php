{{--phần sửa tin tức--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align: center" >Tin Tức
                        <small> {{$tintuc->TieuDe}}</small>
                    </h1>
                    <h2 class="page-header" style="text-align: center">
                        Sửa 
                    </h2>
                </div>
                <!-- /.col-lg-12 -->
                 <!-- /.col-lg-12 -->
                 <div class="col-lg-7" style="padding-bottom:120px">

                    {{--hiện thị lổi--}
                    @if (count($errors) > 0)
                        <div class="fa fa-ban alert alert-danger">
                            {{--in lổi--}
                            @foreach ($errors->all() as $err)
                                {{$err}} <br/>
                            @endforeach
                        </div>
                    @endif

                    {{--hiện thị thông báo--}}
                    @if (session('thongbao'))
                        <div class="fa fa-binoculars alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    
                    <form action={{route('tintuc.sua',$tintuc->id)}} method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">

                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                
                                {{--hiện thị tển thể loại lấy từ biến $theloai trong hàm getThem của controller tin tức truyền qua biến $tl --}}
                                @foreach ($theloai as $tl)
                                    <option 
                                        {{--tin tức nằm trong thể loại nào --}}
                                        {{--kiểm tra tin tức -> có trùng voi id thể loại hay không--}}
                                        @if ($tintuc->loaitin->theloai->id == $tl->id)
                                            {{"selected"}}
                                        @endif
                                        value="{{$tl->id}}">{{$tl->Ten}}</option>  
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">

                            <label>Loại Tin</label>
                            <br>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('LoaiTin'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('LoaiTin') }}
                                    </div>
                                @endif
                            <br>
                            <select class="form-control" name="LoaiTin" id="LoaiTin">
                                
                                {{--hiện thị tển Loại Tin lấy từ biến $loaitin trong hàm getThem của controller tin tức truyền qua biến $lt --}}
                                @foreach ($loaitin as $lt)
                                    <option 
                                        {{--tin tức nằm trong loại tin nào --}}
                                        {{--kiểm tra tin tức -> có trùng id voi id loại tin hay không--}}
                                        @if ($tintuc->loaitin->id == $lt->id)
                                            {{"selected"}}
                                        @endif
                                        value="{{$lt->id}}">{{$lt->Ten}}</option>  
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">

                            <label>Tiêu Đề</label>

                            <br>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('TieuDe'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('TieuDe') }}
                                    </div>
                                @endif
                            <br>

                            <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu Đề Tin" value="{{$tintuc->TieuDe}}"/>
                            
                        </div>
                        <div class="form-group">

                            <label>Tóm Tắt</label>

                            <br>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('TomTat'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('TomTat') }}
                                    </div>
                                @endif
                            <br>

                            <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>

                        </div>
                        <div class="form-group">

                            <label>Nội Dung</label>
                            
                            <br>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('NoiDung'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('NoiDung') }}
                                    </div>
                                @endif
                            <br>

                            <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="3">{{$tintuc->NoiDung}}</textarea>
    
                        </div>
                        <div class="form-group">

                            <label>Hình Ảnh</label>
                            
                            <br>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('Hinh'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('Hinh') }}
                                    </div>
                                @endif
                            <br>
                            
                            <p><img width="150px" text-align="center" src="upload/tintuc/{{$tintuc->Hinh}}" /></p>
                            <input class="form-control" name="Hinh" type="file" />
    
                        </div>
                        <div class="form-group">
                            
                            <label>Nổi Bật</label>
                            <label class="radio-inline">
                                <input 
                                {{--kiểm tra xem cái tin có nổi bật hay không--}}
                                    @if ($tintuc->NoiBat == 0)
                                        {{"checked"}}
                                    @endif
                                    name="NoiBat" value="0"  type="radio">No
                            </label>
                            <label class="radio-inline">
                                <input 
                                    @if ($tintuc->NoiBat == 1)
                                        {{"checked"}}
                                    @endif
                                    name="NoiBat" value="1" type="radio">Yes
                            </label>

                        </div>

                        <button type="submit" class="btn btn-default">Sửa</button>
                        <a href={{route('tintuc.danhsach')}} class="btn btn-default">Cancel</a>

                    <form>

                </div>
            </div>
            <!-- /.row -->

            {{--hiện thị các comment--}}
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="text-align: center" >Comment
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
    
                    {{--hiện thị thông báo--}}
                    @if (session('thongbaocm'))
                        <div class="fa fa-bell alert alert-success">
                            {{session('thongbaocm')}}
                        </div>
                    @endif
    
    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người Dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày Tạo</th>
                                
                                <th>Delete</th>
                                {{--<th>Edit</th>--}}
                            </tr>
                        </thead>
                        <tbody>
    
                            {{--nhận dữ liệu từ biến $tintuc ->comment truyen vao biến $cm--}}
                            @foreach ( $tintuc->comment as $cm )
    
                                <tr class="odd gradeX" align="center">
                                    <th>{{$cm->id}}</th>
                                    <th>{{$cm->user->name}}</th>{{--dùng lien ket trong mode comment trỏ qua table user tới tên của user--}}
                                    <th>{{$cm->NoiDung}}</th>
                                    <th>{{$cm->created_at}}</th> 
                                    
                                    <td class="center"><a class="fa fa-trash-o fa-fw" href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Delete</a></td>
                                    {{--khong cho sua
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/comment/sua/{{$cm->id}}">Edit</a></td> {{--truyền id tin tức muốn sửa vào đường link--}}
                                    
                                </tr>
    
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->

        </div>
        <!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->




@endsection

{{--tạo và sử dụng ajax trong laravel--}}
{{--dữ liệu ở phần script được truyền ra index để đỗ vào biến script--}}
@section('script')

    {{--khi chọn thể loại thi loại tin sẻ dc chọn theo tên thể loại đó --}}
    {{--lấy id của thể loại đó truyền qua cho trang ajax , sau đó trang ajax của id thể loại đó nó tìm những loại tin có cùng id theloai để hiện thị lable loại tin --}}
    <script>
        $(document).ready(function() {
            //alert('nguyên thị thu ') // thong bao trong javascript

            // bắt sự kiện cho thể loại
            
            $('#TheLoai').change(function(){
                var idTheLoai = $(this).val();
                // alert(idTheLoai); tohong baos id theloai
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    //alert(data);
                    // khi lấy dữ liệu về trả dữ liệu vào biên data và truyen qua select id="LoaiTin"
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>

@endsection