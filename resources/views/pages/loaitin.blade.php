
@extends('layout.index')

@section('title')
    Loại Tin
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
                
                    <div class="col-md-9 ">
                            <div class="panel panel-default">
                                <div class="panel-heading" style="background-color:#337AB7; color:white;">
                                    <h4><b>{{$loaitin->Ten}}</b></h4>
                                </div>
                                
                                @foreach ($tintuc as $tt)
                                    
                                    <div class="row-item row">
                                        <div class="col-md-3">
                
                                            
                                                <br>
                                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                            
                                        </div>
                
                                        <div class="col-md-9">
                                            <h3>{{$tt->TieuDe}}</h3>
                                            <p>{!!$tt->TomTat!!}</p>
                                            <a class="btn btn-primary" href={{route('pages.tintuc',[$tt['id'],$tt['TieuDeKhongDau']])}}>Chi Tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                                        </div>
                                        <div class="break"></div>
                                    </div>

                                @endforeach
                                <!-- Pagination -->
                                <div class="row text-center">
                                    <div class="col-lg-12">
                                        <ul class="pagination">
                                            {{--links phan traang trong laravel--}}
                                            {{$tintuc->links()}}
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.row -->
            
                                </div>
                        </div> 
                        
    </div>
    <!-- end Page Content -->
    
@endsection 