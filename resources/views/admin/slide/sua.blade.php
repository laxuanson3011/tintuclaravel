{{--phần sửa slide--}}

{{--trỏ đến file index trong layout--}}
@extends('admin.layout.index')

{{--dữ liệu ở phần page content được truyền ra index để đỗ vào biến content--}}
@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                        <h1 class="page-header" style="text-align: center" >Slide
                                <small> {{$slide->Ten}}</small>
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
                                <div class="fa fa-book alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                            @endif
        
                            {{--khi click vào button sửa thì toàn bộ form chuyển qua route post sửa--}}
                            <form action={{route('slide.sua',$slide->id)}} method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        
                                <div class="form-group">
                                    <label>Tên slide</label>

                                    <br>
                                    {{--hiện thị lổi--}}
                                        @if ($errors->has('Ten'))
                                            <div class="fa fa-ban alert-danger">
                                                    {{ $errors->first('Ten') }}
                                            </div>
                                        @endif
                                    <br>

                                    <input class="form-control" name="Ten" placeholder="Nhập Lại Tên slide" value="{{$slide->Ten}}"/>
                                </div>

                                <div class="form-group">
    
                                        <label>Nội Dung</label>

                                        <br>
                                        {{--hiện thị lổi--}}
                                        @if ($errors->has('NoiDung'))
                                            <div class="fa fa-ban alert-danger">
                                                    {{ $errors->first('NoiDung') }}
                                            </div>
                                        @endif
                                        <br>

                                        <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="3">{{$slide->NoiDung}}</textarea>
                
                                    </div>
                                    <div class="form-group">
            
                                        <label>Link</label>
                                        <input class="form-control" name="link" placeholder="Nhập lại Link slide" value="{{$slide->link}}"/>
                                            
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
                                            <p><img width="150px"  src="upload/slide/{{$slide->Hinh}}" /></p>
                                            <input class="form-control" name="Hinh" type="file" />
                                            
                                    </div>
                                
                                <button type="submit" class="btn btn-default">Sửa</button>
                                <a href={{route('slide.danhsach')}} class="btn btn-default">Cancel</a>
                            <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection