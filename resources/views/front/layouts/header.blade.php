<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Optical Pro</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Uikit -->
    <link rel="stylesheet" href="{{asset('front/css/uikit.min.css')}}">

    <!-- Custom styles for this template -->
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet">
</head>

<body>

<div class="nav-menu">
    <span id="close">&times;</span>
    <ul class="uk-nav-parent-icon nav-bar-list " uk-nav style="padding: 30px;">
        <li class="nav-bar-list__elem"><a href="{{ route('home') }}">Главная</a></li>
        <li class="nav-bar-list__elem uk-parent">
            <a href="#">Каталог</a>
            <ul class="uk-nav-sub">
                @foreach ($parentCategories as $category)
                    <li class="nav-bar-list-dropdown__item"><a href="{{ $category->getAncestorsSlugs() }}">{{ $category->ru_title }}</a></li>
                @endforeach
            </ul>
        </li>
        <li class="nav-bar-list__elem"><a href="{{ route('about') }}">О компании</a></li>
    </ul>
</div>

{{-- <a href="" class="popup" id="popup">
    <i class="fa fa-check"></i>
    <p>
        Выбранный вами товар успешно добавлен в корзину! <br>
        (кол-во товаров: 3)
    </p>
</a> --}}

<header id="header" class="header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-sm-8 col-7">
                <i id="open" class="fa fa-bars"></i>
                <a href="{{ route('home') }}"><img src="{{asset('front/img/main-logo.png')}}" alt="Logo" class="header__logo"></a>
                <nav class="header__nav" uk-navbar="mode: hover">
                    <ul class="uk-navbar-nav">
                        <li class="header__nav__item"><a href="{{ route('home') }}">Главная</a></li>
                        <li class="header__nav__item">
                            <a href="#">Каталог&nbsp; <i class="fa fa-angle-down"></i></a>

                            <div class="uk-navbar-dropdown" style="width: auto; padding: 0; white-space: nowrap; margin-top: 0;">
                                <ul class="uk-nav uk-navbar-dropdown-nav header__nav__dropdown">
                                    @foreach ($parentCategories as $category)
                                        <li class="header__nav__dropdown__item">
                                            <a href="{{ $category->getAncestorsSlugs() }}">{{ $category->ru_title }}</a>
                                            <ul class="uk-nav-sub">
                                                @foreach ($category->children as $child)
                                                    <li><a href="{{ $child->getAncestorsSlugs() }}">{{ $child->ru_title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- End -->

                        </li>
                        <li class="header__nav__item"><a href="{{ route('about') }}">О компании</a></li>
                    </ul>
                </nav>
            </div>
            <!-- /.col-6 -->
            <div>
                <div class="header-wrapper">
                        <a href="{{ route('cart.index') }}">
                            <img class="header__bag" src="{{asset('front/img/header-bag.png')}}" alt="Bag">
                        </a>
                        <span class="header__bag__quan" id="cartCount">@if(isset($cartTotalCount)) {{ $cartTotalCount }} @else 0 @endif</span>
                        <span class="header__price"> &nbsp;@if (isset($cartTotalSum)) {{ number_format($cartTotalSum, 0, ',', ' ') }} @else 0 @endif RMB</span>
                    @guest
                        <a class="header__auth" href="{{ route('login') }}">Войти</a>
                        <a class="header__auth_adap" href="{{ route('login') }}"><i class="fa fa-user"></i></a>
                        <a class="header__auth" href="{{ route('register') }}">Регистрация</a>
                        <a class="header__auth_adap" href="{{ route('register') }}"><i uk-icon="sign-in"></i></a>
                    @endguest
                    @auth
                        <a class="header__auth" href="{{ route('logout') }}">Выйти</a>
                        <a class="header__auth_adap" href="{{ route('logout') }}"><i uk-icon="icon: sign-out"></i></a>
                    @endauth
                </div>
            </div>
            <!-- /.col-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</header>
