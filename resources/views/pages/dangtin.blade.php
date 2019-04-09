{{--trỏ đến file index trong layout--}}
@extends('layout.index')

@section('title')
    Đăng Tin
@endsection
{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')



    <!-- Page Content -->
 <div class="container">

    <!-- slider -->
    <div class="row carousel-holder" >
        <div class="col-md-8"></div>
        <div class="col-md-10">
            <div class="panel panel-default">
                    <h1 class="page-header">
                        Đăng Tin
                    </h1>
            </div>
                <!-- /.col-lg-12 -->
                <div class="col-md-12" style="padding-bottom:120px">

                    {{--hiện thị lổi
                    @if (count($errors) > 0)
                        <div class="fa fa-ban alert alert-danger">
                            {{--in lổi--}
                            @foreach ($errors->all() as $err)
                                {{$err}} <br/>
                            @endforeach
                        </div>
                    @endif
                    --}}

                    
                    {{--hiện thị thông báo--}}
                    @if (session('thongbao'))
                        <div class="fa fa-bell alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    
                   
                    <form action="pages/dangtin" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="form-group">

                            <label>Thể loại</label>
                            <select class="form-control" name="TheLoai" id="TheLoai">
                                
                                {{--hiện thị tển thể loại lấy từ biến $theloai trong hàm getThem của controller tin tức truyền qua biến $tl --}}
                                @foreach ($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>  
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
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>  
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

                            <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu Đề Tin" />
                            
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

                            <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3"></textarea>

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

                            <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="3"></textarea>
    
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
                            
                            <input class="form-control" name="Hinh" type="file" />
    
                        </div>
                        <div class="form-group">
                            
                            <label>Nổi Bật</label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="0" type="radio">No
                            </label>
                            <label class="radio-inline">
                                <input name="NoiBat" value="1" checked="" type="radio">Yes
                            </label>

                        </div>

                        <button type="submit" class="btn btn-default">Thêm</button>
                       

                    <form>
                
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- end slide -->

<!-- end Page Content -->

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
                $.get("pages/ajax/loaitin/"+idTheLoai,function(data){
                    //alert(data);
                    // khi lấy dữ liệu về trả dữ liệu vào biên data và truyen qua select id="LoaiTin"
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>

@endsection
