@extends('front.layouts.app')

@section('content')
    <section class="auth" id="auth" style="background: #fafafa url({{ asset('front/img/authpage-bg.png') }}) center 20% no-repeat;">
	    <h2 class="auth__title">Для доступа  в данный раздел сайта <br>необходимо пройти регистрацию</h2>
	    <button class="auth__btn">Регистрация <span class="uk-icon-button uk-margin-small-left" href="{{ route('register') }}" uk-icon="arrow-right" style="color: #5697fd;"></span></button>
    </section>
    @include('front.layouts.feedback')
@endsection
