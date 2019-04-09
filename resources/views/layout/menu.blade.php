{{--menu trai--}}

<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li class="list-group-item menu1 active">
            Menu
        </li>

        {{--foreach de duyen cac the loai lay ra tu database--}}
        {{--nhan lai bien $theloai tu ham trangchu cua PageCoontroller VA GANG = $tl --}}
        @foreach ($theloai as $tl)
            
            {{--kiem tra the loai do co loai tin hay khong neu co thi in ra man hinh con khong co thi khong in--}}
            {{--count la ham den xem co bao nhieu  loai tinneu >> 0 thi co loai tin con ngoc lai --}}
            @if (count($tl->loaitin) > 0)
                <li class="list-group-item menu1">
                    {{$tl->Ten}}
                </li>

                <ul>
                    {{--tu cac the loai da co in ra cac loai tin $tl->loaitin gang = $lt--}}
                    @foreach ($tl->loaitin as $lt)
                        <li class="list-group-item">
                            <a href={{route('pages.loaitin',[$lt->id,$lt->TenKhongDau])}}>{{$lt->Ten}}</a>
                        </li>
                    @endforeach
                    
                </ul>
            @endif

        @endforeach
        
    </ul>
        
</div>

{{--
@section('css')
    <link href="{{asset('css/menu.css')}}" rel="stylesheet">
@endsection
<div class="col-md-3 ">
    <nav>
        <ul class="mcd-menu">
            <li>
                <a href=""><i class="fa fa-home"></i><strong>Menu</strong></a>
            </li>
                    
                      {{--foreach de duyen cac the loai lay ra tu database--}}
                        {{--nhan lai bien $theloai tu ham trangchu cua PageCoontroller VA GANG = $tl --}
                        @foreach ($theloai as $tl)
                            
                            {{--kiem tra the loai do co loai tin hay khong neu co thi in ra man hinh con khong co thi khong in--}}
                            {{--count la ham den xem co bao nhieu loai tin--}
                            @if (count($tl->loaitin) > 0)
                            <li>
                                <a href="">
                                    <i class="fa fa-comments-o"></i>
                                    <strong> {{$tl->Ten}}</strong>
                                </a>
                                <ul>
                                    {{--tu cac the loai da co in ra cac loai tin $tl->loaitin gang = $lt--}
                                    @foreach ($tl->loaitin as $lt)
                                        <li><a href="#"><i class="fa fa-globe"></i>{{$lt->Ten}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @endif
                        @endforeach
                    
        </ul>
    </nav>
</div>
--}}