@extends('front.layouts.app')

@section('title', 'Главная')

@section('content')

    <section class="main" id="main">

        <div class="main-slider xs_visible">
            <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="max-height: 490" index="0">

                <ul class="uk-slideshow-items">
                    @foreach($sliders as $slider)
                        <li>
                            <img src="{{ $slider->getImage() }}" alt="" uk-cover>
                            <div class="uk-position-top slideshow-items uk-margin-medium-left">
                                <h1 class="slideshow-items__title">{{ $slider->ru_title }}</h1>
                                <p class="slideshow-items__subtitle">{{ $slider->ru_description }}</p>
                            </div>
                            @if ($slider->link_video)
                                <div class="uk-position-center main-slider-play">
                                    <button class="main-slider-play__btn"><i class="fa fa-play"></i></button>
                                </div>
                            @endif
                            <div class="uk-position-bottom-left uk-position-small uk-margin-medium-left">
                                <button class="slideshow-items__btn"><a href="{{ $slider->link_page }}">Смотреть каталог</a></button>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <a class="uk-position-center-left uk-position-small uk-hidden-hover slide-btn" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover slide-btn" href="#" uk-slidenav-next uk-slideshow-item="next"></a>


            </div>
        </div>

        <div class="container">

            <div class="main-slider xs_hidden">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slideshow="min-height: 0; max-height: 490" index="0">

                    <ul class="uk-slideshow-items">
                        @foreach($sliders as $slider)
                            <li>
                                <img src="{{asset($slider->getImage())}}" alt="" uk-cover>
                                <div class="uk-position-top slideshow-items">
                                    <h1 class="slideshow-items__title">
                                        {{$slider->ru_title}}
                                    </h1>
                                    <p class="slideshow-items__subtitle">{!! $slider->ru_description !!}</p>
                                    <button class="slideshow-items__btn"><a href="{{ $slider->link_page }}">Смотреть каталог</a></button>
                                </div>
                                <div class="uk-position-bottom-left scrolldown"><img src="{{asset('front/img/slider/mouse.png')}}" alt="" class="scrolldown__img"><span class="scrolldown__txt">Листай вниз</span></div>
                                @if ($slider->link_video)
                                    <div class="uk-position-center main-slider-play">
                                        <button class="main-slider-play__btn"><i class="fa fa-play"></i></button><br class="adap_hidden"> <br>
                                        <p class="main-slider-play__txt">Посмотреть <br>  видео 1 мин.</p>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <a class="uk-position-center-left uk-position-small uk-hidden-hover slide-btn" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover slide-btn" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

                    <div class="uk-position-bottom-center uk-position-small">
                        <ul class="uk-dotnav">
                            <li uk-slideshow-item="0"><a href="#">Item 1</a></li>
                            <li uk-slideshow-item="1"><a href="#">Item 2</a></li>
                            <li uk-slideshow-item="2"><a href="#">Item 3</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4 offset-sm-0 col-sm-6 offset-1 col-10">
                    <div class="main-card first">
                        <a href="http://fabricio.vid.uz/solncezashchitnye-ochki"><h4 class="main-card__title">Солнцезащитные очки</h4></a>
                        <span><a href="http://fabricio.vid.uz/solncezashchitnye-ochki/muzhskie">Мужские</a></span> <br>
                        <span><a href="http://fabricio.vid.uz/solncezashchitnye-ochki/zhenskie">Женские</a></span>
                    </div>
                    <!-- /.main-card -->
                </div>
                <!-- /.col-4 -->
                <div class="col-md-4 offset-sm-0 col-sm-6 offset-1 col-10">
                    <div class="main-card second">
                        <a href="http://fabricio.vid.uz/opravy"><h4 class="main-card__title">Оправы</h4></a>
                        <span><a href="http://fabricio.vid.uz/opravy/muzhskie-1">Мужские</a></span> <br>
                        <span><a href="http://fabricio.vid.uz/opravy/zhenskie-1">Женские</a></span>
                    </div>
                    <!-- /.main-card -->
                </div>
                <!-- /.col-4 -->
                <div class="offset-md-0 col-md-4 offset-sm-3 col-sm-6 offset-1 col-10">
                    <div class="main-card third">
                        <a href="http://fabricio.vid.uz/akssesuary"><h4 class="main-card__title">Аксессуары</h4></a>
                        <span><a href="http://fabricio.vid.uz/akssesuary/futlyary">Футляры</a></span> <br>
                        <span><a href="http://fabricio.vid.uz/akssesuary/platochki">Платочки</a></span>
                    </div>
                    <!-- /.main-card -->
                </div>
                <!-- /.col-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /#main.main -->

    <section class="waranty" id="waranty">
        <div class="container">
            <h2 class="section-title">О нас</h2>
            <div class="row">
                <div class="offset-lg-0 col-lg-6 offset-md-1 col-md-10">

                    <div class="quality-card">
                        <h4 class="quality-card__title">Гарантия качества</h4>
                        <!-- /.quality-card__title -->
                        <p class="quality-card__descr">ООО "Optical Pro" ведущая компания в сфере оптической индустрии по всей Республике. Мы занимаем 1 место по поставке оптической продукции.</p>
                        <!-- /.quality-card__descr -->
                        <p class="quality-card__descr">Предоставляем оптическую продукцию международного уровня и ее широкий ассортимент. Мы, также, заботимся о благополучии партнеров. Благодаря взаимовыгодному сотрудничеству, у наших партнеров появляется больше - возможностей для процветания.</p>
                        <!-- /.quality-card__descr -->
                    </div>
                    <!-- /.quality-card -->
                </div>
                <!-- /.col-6 -->

                <div class="offset-lg-0 col-lg-3 offset-md-1 col-md-5 offset-sm-0 col-sm-6 offset-1 col-10">
                    <div class="waranty-card bg-wave">
                        <img src="{{asset('front/img/waranty/card2.png')}}" alt="" class="waranty-card__img">
                        <h5 class="waranty-card__title">Качество</h5>
                        <!-- /.waranty-card__title -->
                        <p class="waranty-card__descr">Мы нацелены на улуч- шения своего сервиса, расширения салонов и повышения узнавае-мости наших брендов.</p>
                        <!-- /.waranty-card__descr -->
                    </div>
                    <!-- /.waranty-card -->
                </div>
                <!-- /.col-3 -->

                <div class="col-lg-3 col-md-5 offset-sm-0 col-sm-6 offset-1 col-10">
                    <div class="waranty-card">
                        <img src="{{asset('front/img/waranty/card3.png')}}" alt="" class="waranty-card__img">
                        <h5 class="waranty-card__title">Дружный коллектив</h5>
                        <!-- /.waranty-card__title -->
                        <p class="waranty-card__descr">Компания Optical Pro -  дружный коллектив со своими принципами и традициями. Для нас на 1 месте это качество.</p>
                        <!-- /.waranty-card__descr -->
                    </div>
                    <!-- /.waranty-card -->
                </div>
                <!-- /.col-3 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /#waranty.waranty -->

    <section class="map" id="map">
        <div class="container">
            <h2 class="section-title">Карта</h2>
            <!-- /.section-title -->
            <div class="map-wrapper">
                <div class="map-txt">
                    <h4 class="map-txt__title">Доставка</h4>
                    <!-- /.map-txt__title -->
                    <p class="map-txt__descr">Мы гарантируем бесперебойность поставок с нашего производства - в ваш магазин.</p>
                    <!-- /.map-txt__descr -->
                </div>
                <!-- /.map-txt -->
            </div>
        </div>
        <!-- /.container -->
    </section>
    <!-- /#map.map -->

    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Преимущества</h2>
            <!-- /.section-title -->
            <div class="features-wrapper">

                <div class="row">

                    <div class="col-lg-4 col-md-6 offset-md-0 col-10 offset-1">
                        <div class="features-block">
                            <img src="{{asset('front/img/features/1.png')}}" alt="" class="features-block__img">
                            <div class="features-block__txt">
                                <h5 class="features-block__title">Преимущество</h5>
                                <p class="features-block__descr">В этом месте рекомендуется раз- тить инфу о всех преимуществах</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-6 -->

                    <div class="offset-xl-4 offset-lg-3 col-lg-4 col-md-6 offset-md-0 col-10 offset-1">
                        <div class="features-block">
                            <img src="{{asset('front/img/features/2.png')}}" alt="" class="features-block__img">
                            <div class="features-block__txt">
                                <h5 class="features-block__title">Преимущество</h5>
                                <p class="features-block__descr">В этом месте рекомендуется раз- тить инфу о всех преимуществах</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-6 -->

                </div>
                <!-- /.row -->

                <div class="row features-blocks">

                    <div class="col-lg-4 col-md-6 offset-md-0 col-10 offset-1">
                        <div class="features-block">
                            <img src="{{asset('front/img/features/3.png')}}" alt="" class="features-block__img">
                            <div class="features-block__txt">
                                <h5 class="features-block__title">Преимущество</h5>
                                <p class="features-block__descr">В этом месте рекомендуется раз- тить инфу о всех преимуществах</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-6 -->

                    <div class="offset-xl-4 offset-lg-3 col-lg-4 col-md-6 offset-md-0 col-10 offset-1">
                        <div class="features-block">
                            <img src="{{asset('front/img/features/4.png')}}" alt="" class="features-block__img">
                            <div class="features-block__txt">
                                <h5 class="features-block__title">Преимущество</h5>
                                <p class="features-block__descr">В этом месте рекомендуется раз- тить инфу о всех преимуществах</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-6 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.features-wrapper -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /#features.features -->

    @if ($products->count() > 0)
        <section class="goods" id="goods">
            <div class="container">
                <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="">

                    <h2 class="section-title uk-position-relative" style="color: black;">Солнцезащитные очки</h2>

                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-3@m uk-child-width-1-4@l">
                        @foreach($products as $product)
                            <li>

                                <div class="goods-card">
                                    <a href="{{ $product->getAncestorsSlugs() }}" class="goods-card__img">
                                        @foreach ($product->colors as $key => $color)
                                            <img src="{{ $color->images()->first()->getCatalogImage() }}" alt="{{ $product->title }}" data-color="{{ $color->id }}" @if($key != 0) style="display:none;" @endif>
                                        @endforeach
                                    </a>
                                    <!-- /.goods-card__img -->
                                    <a href="{{ $product->getAncestorsSlugs() }}"><h5 class="goods-card__title">{{ $product->title }}</h5></a>
                                    <!-- /.goods-card__title -->
                                    <div class="goods-card__price">{{ number_format($product->price, 0, ',', ' ') }} RMB</div>
                                    <!-- /.goods-card__price -->
                                    @if ($product->colors()->count() > 0)
                                        <span class="color">Цвет:</span> <br>
                                        @foreach ($product->colors as $color)
                                            <div class="goods-card__color" style="background-color: {{ $color->colorHEX }}" data-color="{{ $color->id }}"></div>
                                        @endforeach
                                    @endif
                                    <div class="goods-card__bag" data-product-id="{{ $product->id }}"></div>
                                </div>
                                <!-- /.goods-card -->

                            </li>
                        @endforeach
                    </ul>


                    <div class="slide-btns">
                        <a class=" slide-btn slide-btns_prev" uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class=" slide-btn slide-btns_next" uk-slidenav-next uk-slider-item="next"></a>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </section>
    @endif
    <!-- /#goods.goods -->
    @include('front.layouts.feedback')

@endsection

@section('js')
    <script>
        jQuery(function() {
            $('.goods-card__bag').on('click', function(e) {
                e.preventDefault();
                let element = $(this);
                let quantity = 1;
                let productId = element.data('product-id');
                $.ajax({
                    url: '{{ route('cart.add') }}',
                    'method': 'post',
                    data: {_token: '{{ csrf_token() }}', productId, quantity: quantity},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        })
    </script>
@endsection
