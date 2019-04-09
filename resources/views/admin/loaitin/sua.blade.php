{{--phần sửa loại tin--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align: center" >Loại Tin
                        <small> {{$loaitin->Ten}}</small>
                    </h1>
                    <h2 class="page-header" style="text-align: center">
                        Sửa 
                    </h2>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">

                    {{--hiện thị lổi
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
                        <div class="fa fa-book alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    {{--khi click vào button sửa thì toàn bộ form chuyển qua route post sửa--}}
                    <form action={{route('loaitin.sua',$loaitin->id)}} method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                                <label>Thể Loại</label>
                                <br>
                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('TheLoai'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('TheLoai') }}
                                        </div>
                                    @endif
                                <br>

                                <select class="form-control" name="TheLoai">
    
                                    {{--hiện thị tển thể loại lấy từ biến $theloai trong hàm getThem của controller loại tin truyền qua biến $tl --}}
                                    @foreach ($theloai as $tl)
                                        <option 
                                        {{--kieme trả tên loại tin và id thể loại có trừng voi tên thể loại và id loại tin--}}
                                         @if ($loaitin->idTheLoai == $tl->id )
                                             {{--hiện thị ra ten the loai--}}
                                            {{"selected"}}
                                         @endif
                                        value="{{$tl->id}}">{{$tl->Ten}}</option>  
                                    @endforeach
                                    
                                    
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Tên Loại Tin</label>
                            <br>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('Ten'))
                                    <div class="fa fa-ban alert-danger">
                                        {{ $errors->first('Ten') }}
                                    </div>
                                @endif
                            <br>
                            <input class="form-control" name="Ten" placeholder="Nhập Tên Loại Tin" value="{{$loaitin->Ten}}" />
                        </div>
                        
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <a href={{route('loaitin.danhsach')}} class="btn btn-default">Cancel</a>
                    <form>

                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection