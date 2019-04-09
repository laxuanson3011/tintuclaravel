
<!-- slide -->

<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                {{--tao 1 bien den $i de truyen den cai data-slide-to --}}
                <?php $i=0; ?>
                {{--nhan lai bien $slide va gang bang sd--}}
                @foreach ($slide as $sd)
                
                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" 
                    {{--gang cai $=0 = class  --}}
                    @if ($i == 0)
                        class="active"
                    @endif ></li>
                    {{--1 vong tang i len 1 --}}
                <?php $i++; ?>

                @endforeach
            </ol>

            <div class="carousel-inner">
                {{--tao 1 bien den $i de truyen den cai class="item active" --}}
                <?php $i=0; ?>
                {{--nhan lai bien $slide va gang bang sd--}}
                @foreach ($slide as $sd)

                    <div 
                        {{--gang cai $=0 = class  --}}
                        @if ($i == 0)
                            class="item active"
                        @else
                            class="item"
                        @endif
                    >
                     {{--1 vong tang i len 1 --}}
                    <?php $i++; ?>

                        <img class="slide-image" src="upload/slide/{{$sd->Hinh}}" alt="{{$sd->Ten}}">

                    </div>

                @endforeach
                
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>

<!-- end slide -->