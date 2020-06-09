@extends('admin.layouts.app')

@section('contentDiv', true)

@section('content')

    <div class="bg-image" style="background-image: url('{{ asset('assets/img/photos/photo2@2x.jpg') }}');">
        <div class="hero bg-primary-dark-op">
            <div class="hero-inner">
                <div class="content content-full text-center">
                    <h1 class="display-4 font-w700 text-white mb-10 js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown">Добро пожаловать!</h1>
                    <h2 class="font-w400 text-white-op mb-50 js-appear-enabled animated fadeInUp" data-toggle="appear" data-class="animated fadeInUp" data-timeout="250">Настало время делать невероятные проекты!</h2>
                    {{--<a class="btn btn-hero btn-noborder btn-rounded btn-primary js-appear-enabled animated bounceIn" data-toggle="appear" data-class="animated bounceIn" data-timeout="750" href="be_layout_hero_image.html">--}}
                        {{--<i class="si si-rocket mr-10"></i> Get Started--}}
                    {{--</a>--}}
                </div>
            </div>
        </div>
    </div>

@endsection