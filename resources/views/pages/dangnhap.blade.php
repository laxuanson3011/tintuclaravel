 
 @extends('layout.index')

 @section('title')
     Đăng Nhập
 @endsection
 
 @section('content')
 
 
 
 <!-- Page Content -->
 <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">

                        {{--hien thi thong bao login--}}
                        @if (session('loi'))
                        <div class="fa fa-ban alert alert-danger">
                                {{session('loi')}}
                            </div>
                        @endif

                        {{--hiện thị thông báo login--}}
                        @if (session('thongbaodangnhap'))
                            <div class="fa fa-bell alert alert-success">
                                {{session('thongbaodangnhap')}}
                            </div>
                        @endif

                        <form action={{route('pages.dangnhap')}} method="POST" >
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
							<div>
                                <label>Email</label>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('email'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('email') }}
                                    </div>
                                @endif
							  	<input type="email" class="form-control" placeholder="Nhập Địa Chỉ Email" name="email">
							</div>
							<br>	
							<div>
                                <label>Mật khẩu</label>
                                {{--hiện thị lổi--}}
                                @if ($errors->has('password'))
                                    <div class="fa fa-ban alert-danger">
                                            {{ $errors->first('password') }}
                                    </div>
                                @endif
							  	<input type="password" class="form-control" placeholder="Nhập Password" name="password">
							</div>
                            <br>
                            
							<button type="submit" class="btn btn-default">Đăng nhập</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->

@endsection