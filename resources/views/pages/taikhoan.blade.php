
@extends('layout.index')

@section('title')
    Tài Khoản
@endsection

{{--javascrip doi mat khau --}}
{{--truyen class password vao cho input--}}
@section('script')
    <script>
        //bat su kien cho checkbox
        $(document).ready(function(){
            //truyem toi cho id changePassword
            $("#changePassword").change(function(){
                // neu checked bat len class password hien thi
                if($(this).is(":checked"))
                {
                    // tat thuoc tinh disabled
                    $(".password").removeAttr('disabled');
                }
                else
                {
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
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
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">

						    {{--hiện thị thông báo--}}
							@if (session('thongbao'))
								<div class="fa fa-binoculars alert alert-success">
									{{session('thongbao')}}
								</div>
							@endif

							
						  
						<form  action={{route('pages.taikhoan',$user->id)}} method="POST"  enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				    		<div>
								<!-- col-md-6 -->
								<div class="col-md-6">
									<label>Họ tên</label>
									<br>
										{{--hiện thị lổi--}}
										@if ($errors->has('name'))
											<div class="fa fa-ban alert-danger">
													{{ $errors->first('name') }}
											</div>
										@endif
									<br>
									<input class="form-control" name="name" placeholder="Nhập Họ Tên" value="{{$user->name}}"/>
								</div>
								<!--end col-md-6-->

								<!-- col-md-6 -->
								<div class="col-md-6">
									<label>Hình Ảnh</label>
									<br>
										{{--hiện thị lổi--}}
										@if ($errors->has('Hinh'))
											<div class="fa fa-ban alert-danger">
													{{ $errors->first('Hinh') }}
											</div>
										@endif
									<br>
									<p><img class="img-circle" width="100" height="100"  src="upload/user/{{$user->Hinh}}" /></p>
									<input class="form-control" name="Hinh" type="file" />
								</div>
								<!--end col-md-6-->
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
						   		<input class="form-control" name="email" placeholder="Nhập Địa Chỉ Email" type="email" value="{{$user->email}}" readonly=""/>
					   		</div>
							<br>	
							<div>
								{{--khi nguoi dung khong muon doi pass thi khong click vao checkbox khi muon doi pass thi click vao checkbox no se hien thi  2 cai input de doi --}}
								<input type="checkbox" name="changePassword" id="changePassword">
				    			<label>Đổi mật khẩu</label>
								<br>
									{{--hiện thị lổi--}}
									@if ($errors->has('password'))
										<div class="fa fa-ban alert-danger">
												{{ $errors->first('password') }}
										</div>
									@endif
								<br>
									{{--nhan class password tu javascrip--}}
								<input class="form-control password" name="password" placeholder="Nhập Password" type="password" disabled=""/>
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
								{{--nhan class password tu javascrip--}}
						   		<input class="form-control password" name="passwordAgain" placeholder="Nhập lại Password" type="password" disabled=""/>
							</div>
							<br>
							<button type="submit" class="btn btn-default">Sủa</button>

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