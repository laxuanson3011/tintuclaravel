{{--phần sửa thể loại--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align: center" >Thể Loại
                        <small> {{$theloai->Ten}}</small>
                    </h1>
                    <h2 class="page-header" style="text-align: center">
                        Sửa 
                    </h2>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    {{--
                    c1
                    @if (count($errors) > 0)
                        <div class="fa fa-ban alert alert-danger">
                            {{--in lổi
                            @foreach ($errors->all() as $err)
                                {{$err}} <br/>
                            @endforeach
                        </div>
                    @endif
                    --}}
                    {{--hiện thị thông báo--}}
                    @if (session('thongbao'))
                        <div class="fa fa-book alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    {{--khi click vào button sửa thì toàn bộ form chuyển qua route post sửa--}}
                    <form action={{route('theloai.sua',$theloai->id)}} method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                        <div class="form-group">
                            <label>Tên Thể Loại</label>

                            <br>
                                {{-- c2 : hiện thị lổi--}}
                                @if ($errors->has('Ten'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('Ten') }}
                                    </div>
                                @endif
                            <br>
                            
                            <input class="form-control" name="Ten" placeholder="Nhập Lại Tên Thể Loại" value="{{$theloai->Ten}}"/>
                        </div>
                        
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <a href={{route('theloai.danhsach')}} class="btn btn-default">Cancel</a>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection
