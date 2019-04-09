@extends('layout.index')

@section('title')
    Tin Tức
@endsection

@section('content')

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><strong>{{$tintuc->TieuDe}}</strong></h1>

                <!-- Author -->
                
                {{--trong mode tintuc co tron sang ham user  de lay cac nguoi dung--}}
                
                <p>
                    <em>Người Đăng</em> : <strong>{{$tintuc->user->name}}</strong>
                </p>
                

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <br>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on : {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <strong><p class="lead">{!!$tintuc->TomTat!!}</p></strong>

                <hr>

                <p>{!!$tintuc->NoiDung!!}</p>
                
                <br>

                {{--like va share tren facebook---}}
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                 {{--share trong google --}}
                 <g:plusone size="medium"></g:plusone>
                
                <hr>

                <!-- Blog Comments -->

                <div>
                    @if ( Auth::check())
                        <!-- Comments Form -->
                        <div class="well">

                            {{--hiện thị thông báo comment--}}
                            @if (session('thongbao'))
                                <div class="fa fa-bell alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif

                                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                                <form action="pages/comment/{{$tintuc->id}}" method="POST" role="form">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <div class="form-group">
                                        <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                </form>
                            </div>
                    @else
                        <p>dang nhap </p>
                    @endif
                </div>

                <hr>

                <!-- Posted Comments -->

                {{--trong mode tintuc co tron sang bang comment de lay cac nhan xet cua nguoi dung--}}
                @foreach ($tintuc->comment as $cm)
                    <!-- Comment -->  
                    <div class="media">
                        <a class="pull-left" >
                            <img class="img-rounded" width="50" height="50" src="upload/user/{{$cm->user->Hinh}}" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cm->user->name}}{{--ten user--}}
                                <br>
                                <small>{{$cm->created_at}}</small>
                            </h4>
                            {{$cm->NoiDung}}
                        </div>
                    </div>
    
                @endforeach
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        {{--nhan $tin lien quan tu ham tintuc trong pagescontroler --}}
                        @foreach ($tinlienquan as $tlq)

                            <!-- item -->
                         <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    
                                        <img class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="">
                                    
                                </div>
                                <div class="col-md-7">
                                <a href={{route('pages.tintuc',[$tlq->id,$tlq->TieuDeKhongDau])}}><b>{{$tlq->TieuDe}}</b></a>
                                </div>
                                <br>
                                <p>{!!$tlq->TomTat!!}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                            
                        @endforeach
                        
                      
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        {{--nhan tinnoibat cua ham tintuc trong pagescontroller --}}
                        @foreach ($tinnoibat as $tnb)
                            <!-- item -->
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    
                                        <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="">
                                    
                                </div>
                                <div class="col-md-7">
                                    <a href={{route('pages.tintuc',[$tnb->id,$tnb->TieuDeKhongDau])}}><b>{{$tnb->TieuDe}}</b></a>
                                </div>
                                <br>
                                
                                <p>{!!$tnb->TomTat!!}</p>
                                <div class="break"></div>
                            </div>
                            <!-- end item -->
                        @endforeach

                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection


@section('script')

    {{--chia se tren google--}}
    <script src="https://apis.google.com/js/plusone.js" ></script>
    

    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2"></script>
@endsection