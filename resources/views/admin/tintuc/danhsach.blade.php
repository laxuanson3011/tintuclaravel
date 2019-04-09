{{--phần  hiện thị danh sach tin tức--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

     <!-- Page Content -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
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
                            <th>Tiêu Đề</th>
                            <th>Tiêu Đề Không Dấu</th>
                            <th>Tóm Tắt</th>
                            <th>Nội Dung</th>
                            <th>Thể Loại</th>
                            <th>Loại Tin</th>
                            <th>Số Lượt Xem</th>
                            <th>Nổi Bật</th>
                
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{--nhận dữ liệu từ biến $tintuc truyen vao bien  $tt--}}
                        @foreach ( $tintuc as $tt)

                            <tr class="odd gradeX" align="center">
                                <th>{{$tt->id}}</th>
                                <th><p>{{$tt->TieuDe}}</p>
                                    <img width="80px" src="upload/tintuc/{{$tt->Hinh}}" />
                                </th>
                                <th>{{$tt->TieuDeKhongDau}}</th>
                                <th>{!!$tt->TomTat!!}</th>
                                <th>{!!$tt->NoiDung!!}</th>
                                <th>{{$tt->loaitin->theloai->Ten}}</th> {{--dùng lien ket trong mode tử tin tưc trỏ qua table loại tin trỏ qua table thể loai trỏ qua tên thể loại đó --}}
                                <th>{{$tt->loaitin->Ten}}</th>
                                <th>{{$tt->SoLuotXem}}</th>
                                <th>
                                    @if ($tt->NoiBat == 0)
                                        {{'No'}}
                                    @else
                                        {{'Yes'}}
                                    @endif
                                </th>
                                
                                <td class="center"><a class="fa fa-trash-o  fa-fw" href={{route('tintuc.xoa',$tt->id)}}>Delete</a></td>
                                <td class="center"><a class="fa fa-pencil fa-fw" href={{route('tintuc.sua',$tt->id)}}>Edit</a></td> {{--truyền id tin tức muốn sửa vào đường link--}}
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
