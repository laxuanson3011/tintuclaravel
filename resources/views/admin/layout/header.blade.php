{{--phần header--}}

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">Admin - Xuân Sơn</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                {{----}}

                {{--kiểm tra tồn tại hay khong--}}
                @if (Auth::check())
                    <li align="center" ><img class="img-circle" width="50" height="50"  src="upload/user/{{Auth::user()->Hinh}}" /></li>
                    <li><a class="fa fa-user fa-fw" > {{Auth::user()->name}}</a></li>
                    <li><a class="fa fa-gear fa-fw" href={{route('user.sua',Auth::user()->id)}}> Settings</a></li>
                    <li class="divider"></li>
                    <li><a class="fa fa-sign-out fa-fw" href={{route('logout')}}> Logout</a></li>
                @endif
                

            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    {{--hiện thị phần menu--}}
    @include('admin.layout.menu')
    
    <!-- /.navbar-static-side -->
</nav>