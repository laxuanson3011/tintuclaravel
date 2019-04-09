{{--phần menu trong phần header--}}

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a class="fa fa-dashboard fa-fw">Dashboard</a>
            </li>
            <li>
                <a><i class="fa fa-bar-chart-o fa-fw"></i> Thể Loại<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="fa fa-book" href={{route('theloai.danhsach')}}> Danh Sách</a>
                    </li>
                    <li>
                        <a class="glyphicon glyphicon-plus" href={{route('theloai.them')}}> Thêm</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a><i class="fa fa-cube fa-fw"></i> Loại Tin<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="fa fa-book" href={{route('loaitin.danhsach')}}> Danh Sách</a>
                    </li>
                    <li>
                        <a class="glyphicon glyphicon-plus" href={{route('loaitin.them')}}> Thêm</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a><i class="fa fa-newspaper-o fa-fw"></i> Tin Tức<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="fa fa-book" href={{route('tintuc.danhsach')}}> Danh Sách</a>
                        </li>
                        <li>
                            <a class="glyphicon glyphicon-plus" href={{route('tintuc.them')}}> Thêm</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
            </li>
            <li>
                <a><i class="fa fa-cab fa-fw"></i> Slide<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="fa fa-book" href={{route('slide.danhsach')}}> Danh Sách</a>
                        </li>
                        <li>
                            <a class="glyphicon glyphicon-plus" href={{route('slide.them')}}> Thêm</a>
                        </li>
                    </ul>
                        <!-- /.nav-second-level -->
                </li>
            <li>
                <a><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a class="fa fa-book" href={{route('user.danhsach')}}> Danh Sách</a>
                    </li>
                    <li>
                        <a class="glyphicon glyphicon-plus" href={{route('user.them')}}> Thêm</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>