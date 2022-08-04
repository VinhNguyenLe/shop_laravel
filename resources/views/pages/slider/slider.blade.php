@extends('slider')


<section id="slider">
    <!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @php
                            $j = 0;
                        @endphp
                        @foreach ($slider as $key => $slide)
                            @php
                                $j++;
                            @endphp
                            <li data-target="#slider-carousel" data-slide-to={{ $j - 1 }}
                                class="{{ $j == 1 ? 'active' : '' }}"></li>
                        @endforeach
                        {{-- <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li> --}}
                    </ol>
                    <style type="text/css">
                        img.img.img-responsive.img-slider {
                            height: 350px;
                        }
                    </style>
                    <div class="carousel-inner">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($slider as $key => $slide)
                            @php
                                $i++;
                            @endphp
                            <div class="item {{ $i == 1 ? 'active' : '' }}">
                                <img alt="{{ $slide->slider_desc }}"
                                    src="{{ asset('public/uploads/slider/' . $slide->slider_image) }}" width="100%"
                                    height="370" class="img img-responsive img-slider" style="object-fit: contain">

                            </div>
                        @endforeach


                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
