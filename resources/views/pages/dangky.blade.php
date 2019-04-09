
@extends('layout.index')

@section('title')
    Đăng Ký
@endsection

@section('content')

  <!-- Page Content -->
  <div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                  <div class="panel-heading">Đăng ký tài khoản</div>
                  <div class="panel-body">
                       {{--hiện thị thông báo--}}
                            @if (session('thongbao'))
                                <div class="fa fa-binoculars alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
                    <form action={{route('pages.dangky')}} method="POST" > {{--truyền 1 route vói phương thức post--}}
                     
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div>
                            <label>Họ tên</label>
                            <br>
                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('name'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('name') }}
                                        </div>
                                    @endif
                            <br>
                            <input type="text" class="form-control" placeholder="Nhập Họ Tên !!!" name="name">
                        </div>

                        <br>
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
                        <br>
                        <div>
                            <label>Email</label>
                            <br>
                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('email'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('email') }}
                                        </div>
                                    @endif
                            <br>
                            <input type="email" class="form-control" placeholder="Nhập Email !!!" name="email">
                        </div>
                        <br>	
                        <div>
                            
                            <label>Nhập mật khẩu</label>
                            <br>
                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('password'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('password') }}
                                        </div>
                                    @endif
                            <br>
                            <input type="password" class="form-control" placeholder="Nhập Password !!!" name="password">
                        </div>
                        <br>
                        <div>
                            <label>Nhập lại mật khẩu</label>
                            <br>
                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('passwordAgain'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('passwordAgain') }}
                                        </div>
                                    @endif
                            <br>
                            <input type="password" class="form-control" placeholder="Nhập Lại Password !!!" name="passwordAgain">
                        </div>
                       
                        <br>
                        <button type="submit" class="btn btn-default">Đăng ký</button>

                    </form>
                  </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->

@endsection 