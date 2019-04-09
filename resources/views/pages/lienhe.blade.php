@extends('layout.index')

@section('title')
    Lien He
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

        <div class="col-md-9">

                <div class="panel panel-default">            
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
                        
                        <div class="break"></div>
                        <h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>THUA THIEN HUE </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>XUANSON.TTH.DN@GMAIL.COM </p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>0905865398 </p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/d/viewer?ie=UTF8&hl=en&msa=0&ll=16.27477658002563%2C107.86402401818964&spn=0.119703%2C0.15398&source=embed&mid=1_zQxZTBHycRHOLsI4QY6TQ8uMW4&z=18" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

                    </div>
                </div>
            </div>

        </div>
<!-- /.row -->
    </div>
<!-- end Page Content -->

@endsection 