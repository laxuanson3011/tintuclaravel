{{--phần  hiện thị danh sach slide--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
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
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Hình</th>
                            <th>Nội Dung</th>
                            <th>Link</th>
                            <td>Ngày Tạo</td>

                            
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{--nhận dữ liệu từ biến $slide truyen vao bien  $sd--}}
                        @foreach ( $slide as $sd )
                        
                            <tr class="odd gradeX" align="center">
                                <td>{{$sd->id}}</td> {{--in ra id của slide có trong bảng slide--}}
                                <td>{{$sd->Ten}}</td> {{--in ra tên của slide có trong bảng slide--}}
                                {{--in hình slide--}}
                                <td>
                                    <img width="100px" src="upload/slide/{{$sd->Hinh}}"/>
                                </td>
                                <td>{{$sd->NoiDung}}</td> {{--in ra nội dung của slide có trong bảng slide--}}
                                <td>{{$sd->link}}</td>
                                <td>{{$sd->created_at}}</td>

                                <td class="center"><a class="fa fa-trash-o fa-fw" href={{route('slide.xoa',$sd->id)}}>Delete</a></td>
                                <td class="center"><a class="fa fa-pencil fa-fw" href={{route('slide.sua',$sd->id)}}>Edit</a></td> {{--truyền id thể loại muốn sửa vào đường link--}}
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
