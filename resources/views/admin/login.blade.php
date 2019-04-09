{{--giao điện login--}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lập Trình Laravel Framework 5.x">
    <meta name="author" content="">

    <title>Admin - Login</title>
    {{--<base href="{{asset('')}}"--}}

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('admin_asset/bower_components/metisMenu/dist/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('admin_asset/dist/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('admin_asset/bower_components/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">

                        {{--hien thi thong bao login--}}
                        @if (session('thongbaolg'))
                        <div class="fa fa-ban alert alert-danger">
                                {{session('thongbaolg')}}
                            </div>
                        @endif

                        {{--hien thi thong bao nhan tu AdminLoginmiddleware--}}
                        @if (session('thbolog'))
                        <div class="fa fa-ban alert alert-danger">
                                {{session('thbolog')}}
                            </div>
                        @endif

                        <form role="form" action={{route('login')}} method="POST">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <fieldset>
                                <div class="form-group">

                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('email'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('email') }}
                                        </div>
                                    @endif

                                    <input class="form-control" name="email" placeholder="Nhập Địa Chỉ Email" type="email" autofocus/>
                                </div>
                                <div class="form-group">

                                    {{--hiện thị lổi--}}
                                    @if ($errors->has('password'))
                                        <div class="fa fa-ban alert-danger">
                                                {{ $errors->first('password') }}
                                        </div>
                                    @endif

                                    <input class="form-control" name="password" placeholder="Nhập Password" type="password" value=""/>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('admin_asset/bower_components/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('admin_asset/bower_components/metisMenu/dist/metisMenu.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('admin_asset/dist/js/sb-admin-2.js')}}"></script>

</body>

</html>
