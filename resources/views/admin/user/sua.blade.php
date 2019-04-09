{{--phần sửa user--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="text-align: center" >USER
                            <small> {{$user->name}}</small>
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
                        <div class="fa fa-binoculars alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
   
                    <form action={{route('user.sua',$user->id)}} method="POST"  enctype="multipart/form-data"> {{--truyền 1 route vói phương thức post--}}
                        
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                           <div class="form-group">
                               <label>Tên Người Dùng</label>
                               <br>
                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('name'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                <br>
                               <input class="form-control" name="name" placeholder="Nhập Tên Người Dùng" value="{{$user->name}}"/>
                           </div>

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
                                <p><img class="img-circle" width="100" height="100"  src="upload/user/{{$user->Hinh}}" /></p>
                                <input class="form-control" name="Hinh" type="file" />
                            
                            </div>

                           <div class="form-group">
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

                           <div class="form-group">

                               {{--khi nguoi dung khong muon doi pass thi khong click vao checkbox khi muon doi pass thi click vao checkbox no se hien thi  2 cai input de doi --}}
                               <input type="checkbox" name="changePassword" id="changePassword">
                               <label>Change Password</label>
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

                           <div class="form-group">
                               <label>Nhập Lại Password</label>
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
                           
                           <div class="form-group">
                               <label>Quyền Người Dùng</label>
                               <label class="radio-inline">
                                   <input 
                                        @if ($user->quyen == 0)
                                            {{"checked"}}
                                        @endif
                                   name="quyen" value="0"  type="radio">Users
                               </label>
                               <label class="radio-inline">
                                   <input 
                                   @if ($user->quyen == 1)
                                        {{"checked"}}
                                    @endif
                                   name="quyen" value="1"  type="radio">Admin
                               </label>
                               
                           </div>

                           <button type="submit" class="btn btn-default">Sủa</button>
                           <a href={{route('user.danhsach')}} class="btn btn-default">Cancel</a>
                       <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

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