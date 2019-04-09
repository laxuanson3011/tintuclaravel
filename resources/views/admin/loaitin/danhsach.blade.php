{{--phần hiện thị danh sách loại tin--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại Tin
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

                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên Không Dấu</th>
                            <th>Thể Loại</th>
                            <th>Ngày Tạo</th>

                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--nhận dữ liệu từ biến $loaitin truyen vao bien  $lt--}}
                        @foreach ( $loaitin as $lt )
                        
                            <tr class="odd gradeX" align="center">
                                <td>{{$lt->id}}</td> {{--in ra id của loại tin có trong bảng loại tin--}}
                                <td>{{$lt->Ten}}</td> {{--in ra tên của loại tin có trong bảng loại tin--}}
                                <td>{{$lt->TenKhongDau}}</td> {{--in ra tên không dấu của loại tin có trong bảng loại tin--}}
                                <td>{{$lt->theloai->Ten}}</td> {{--in ra tên the loai của loại tin có trong bảng loại tin--}}
                                <td>{{$lt->created_at}}</td>

                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href={{route('loaitin.xoa',$lt->id)}}> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href={{route('loaitin.sua',$lt->id)}}>Edit</a></td> {{--truyền id thể loại muốn sửa vào đường link--}}
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
