{{--phần hiện thị danh sach thể loại--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể Loại
                        <small>Danh Sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->

                {{--hiện thị thông báo--}}
                @if (session('thongbao'))
                    <div class="fa fa-bell alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif

                 {{--hiện thị thông báo login--}}
                 @if (session('thongbaologin'))
                    <div class="fa fa-bell alert alert-success">
                        {{session('thongbaologin')}}
                    </div>
                 @endif

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên Không Dấu</th>
                            <td>Ngày Tạo</td>

                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--nhận dữ liệu từ biến $theloai truyen vao bien  $tl--}}
                        @foreach ( $theloai as $tl )
                        
                            <tr class="odd gradeX" align="center">
                                <td>{{$tl->id}}</td> {{--in ra id của thể loại có trong bảng thể loại--}}
                                <td>{{$tl->Ten}}</td> {{--in ra tên của thể loại có trong bảng thể loại--}}
                                <td>{{$tl->TenKhongDau}}</td> {{--in ra tên không dấu của thể loại có trong bảng thể loại--}}
                                <td>{{$tl->created_at}}</td>

                                <td class="center"><a class="fa fa-trash-o  fa-fw" href={{route('theloai.xoa',$tl->id)}}>Delete</a></td>
                                <td class="center"><a class="fa fa-pencil fa-fw" href={{route('theloai.sua',$tl->id)}}>Edit</a></td> {{--truyền id thể loại muốn sửa vào đường link--}}
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
