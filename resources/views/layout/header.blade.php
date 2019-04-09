
{{--
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Tin Tức</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href={{route('pages.trangchu')}}>Trang Chủ</a>
                </li>
                <li>
                    <a href={{route('pages.gioithieu')}}>Giới thiệu</a>
                </li>
                <li>
                    <a href={{route('pages.lienhe')}}>Liên hệ</a>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
                
                    <button class="btn btn-default" type="button">
                        <i class="fa-search"></i>
                    </button>
                
            </form>

            <ul class="nav navbar-nav pull-right">
                <li>
                    <a href={{route('pages.dangky')}}>Đăng ký</a>
                </li>
                <li>
                    <a href={{route('pages.dangnhap')}}>Đăng nhập</a>
                </li>

                @if (Auth::check())
                    <li>
                        <a href={{route('pages.taikhoan',Auth::user()->id)}}>
                            <span class ="glyphicon glyphicon-user"></span>
                            {{Auth::user()->name}}
                        </a>
                    </li>
                @endif

                <li>
                    <a href={{route('pages.dangxuat')}}>Đăng xuất</a>
                </li>
                
            </ul>
        </div>


        
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
--}}
<nav class="navbar navbar-inverse navbar-fixed-top" role="">
    <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->  
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" > Tin Tức</a>
        </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href={{route('pages.trangchu')}}>Trang Chủ</a>
                        </li>
                        <li>
                            <a href={{route('pages.gioithieu')}}>Giới thiệu</a>
                        </li>
                        <li>
                            <a href={{route('pages.lienhe')}}>Liên hệ</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav pull-right">
                    
                        @if (! Auth::check())
                            <li>
                                <a href={{route('pages.dangky')}}>Đăng ký</a>
                            </li>
                            <li>
                                <a href={{route('pages.dangnhap')}}>Đăng nhập</a>
                            </li>
                        @else
                            <li>
                                <a href={{route('pages.taikhoan',Auth::user()->id)}}>
                                    <span><img class="img-circle" width="25" height="25"  src="upload/user/{{Auth::user()->Hinh}}" /></span>
                                    {{Auth::user()->name}}
                                </a>
                            </li>
                            <li><a href={{route('pages.dangtin',Auth::user()->id)}}>Đăng Tin</a></li>
                            <li>
                                <a href={{route('pages.dangxuat')}}>Đăng xuất</a>
                            </li>
                        @endif
                    
                    </ul>
            </div>
    </div>
</nav>


    

