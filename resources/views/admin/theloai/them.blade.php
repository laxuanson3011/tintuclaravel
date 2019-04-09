{{--phần thêm thể loại--}}

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
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-12" style="padding-bottom:120px">
                    {{-- c1 : hiện thị lổi
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
                        <div class="fa fa-binoculars alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <form action={{route('theloai.them')}} method="POST" enctype="multipart/form-data"> {{--truyền 1 route vói phương thức post--}}
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
                            <input class="form-control" name="Ten" placeholder="Nhập Tên Thể Loại" />
                        </div>
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <a href={{route('theloai.danhsach')}} class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<!-- /#page-wrapper -->

@endsection
