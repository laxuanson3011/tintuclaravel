{{--giao diện trang chủ--}}
@extends('layout.index')

@section('title')
    Trang chủ
@endsection

@section('content')

    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        @include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            
            {{--menu--}}
            @include('layout.menu')

           
            
            <div class="col-lg-9">
                <div class="panel panel-default">            
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức</h2>
                    </div>

                    <div class="panel-body">

                        {{--foreach de duyen cac the loai lay ra tu database--}}
                        {{--nhan lai bien $theloai tu ham trangchu cua PageCoontroller VA GANG = $tl --}}
                        @foreach ($theloai as $tl)
                            {{--neu the loai ma khong co lai tin thi k in ra con neu co thi in ra--}}
                            {{--dem tat ca loai tin ben trong the loai neu > 0 co oai tin con nguoc lai thi k co  --}}
                            @if (count($tl->loaitin) > 0)

                                <!-- item -->
                                <div class="row-item row">
                                    <h3>
                                        <a>{{$tl->Ten}}</a> | 

                                            @foreach ($tl->loaitin as $lt)

                                                <small>
                                                    <a href={{route('pages.loaitin',[$lt->id,$lt->TenKhongDau])}}><i>{{$lt->Ten}}</i></a> /
                                                </small>   

                                            @endforeach	
                                        
                                        
                                    </h3>
                                    {{--modle tintuc  dc gang bang bien $data--}}
                                    {{--trong 1 the loai lay ra take = 5 tin tuc noi bat 1 tin de ben trai con 4 tin de ben phai  sortByDesc sap xep giam dan --}}
                                    <?php
                                        $data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5); 
                                        $tin1 = $data->shift();//shift lay ra 1 tin trong 5 tin dc khai bao va 4 tin in can lai k lay ra "luu y : shift lay data theo kieu mang"
                                    ?>
                                    {{--@foreach ($loaitin as $lt)--}}

                                    {{--@if (count($lt->tintuc) > 0)--}}
                                        <div class="col-md-8 border-right">

                                            {{--@foreach ($lt->tintuc as $tin1)--}}

                                                <div class="col-md-5">
                                                    
                                                    <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
                                                    
                                                </div>

                                                <div class="col-md-7">
                                                    <a href={{route('pages.tintuc',[$tin1['id'],$tin1['TieuDeKhongDau']])}}><h3>{{$tin1['TieuDe']}}</h3></a>
                                                    <p>{!!$tin1['TomTat']!!}</p>
                                                    <a class="btn btn-primary" href={{route('pages.tintuc',[$tin1['id'],$tin1['TieuDeKhongDau']])}}>Chi Tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                                                </div>
                                                
                                            {{--@endforeach--}}

                                        </div>
                                    {{--@endif--}}
                                        
                                    {{--@endforeach--}}
                                    

                                    <div class="col-md-4">

                                        {{--nhan lai bien $data tu modle tin tuc giang = $tt--}}
                                        @foreach ($data->all() as $tintuc)

                                            <a href={{route('pages.tintuc',[$tintuc['id'],$tintuc['TieuDeKhongDau']])}}>
                                                <h4>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                    {{$tintuc['TieuDe']}}
                                                </h4>
                                            </a>
                                            
                                        @endforeach
                                        

                                    </div>
                                    
                                    <div class="break"></div>
                                </div>
                                <!-- end item -->
                            @endif
                            
                        @endforeach


                        

                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

@endsection 
