@extends('front.layouts.app')

@section('title', $product->title)

@section('content')
    <section class="card" id="card">
        <div class="container">
            @foreach($product->colors as $key => $productColor)
                @if ($productColor->images()->count() > 0)
                    <div uk-slideshow class="card--slider" data-color="{{ $key }}" @if ($key != 0) style="display: none;" @endif>
                        <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">
                            <ul class="uk-slideshow-items card-slideshow__bg">
                                @foreach($productColor->images as $productImage)
                                <li class="card-slideshowItem">
                                    <img class="uk-position-center uk-margin-large-left" src="{{ $productImage->getImage() }}" alt="">

                                    <div class="uk-overlay uk-position-bottom-right uk-position-large">
                                        <p class="card-slideshow">{{ $product->title }}</p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                            <div class="uk-position-bottom-right uk-position-medium card-slideshow__nav">
                                <i class="fa fa-long-arrow-left" uk-slideshow-item="previous"></i>
                                <i class="fa fa-long-arrow-right" uk-slideshow-item="next"></i>
                            </div>
                            <div class="uk-position-center-right uk-position-large card-slideshow__dotnav">
                                <ul class="uk-slideshow-nav uk-dotnav uk-dotnav-vertical"></ul>
                            </div>
                            <div class="uk-position-center-left uk-position-small card-colors">
                                @foreach ($product->colors as $colorKey => $color)
                                    @if ($color->images()->count() > 0)
                                        <div data-color-hex="{{ $color->colorHEX }}" data-color-name="{{ $color->name }}" class="circle-wrapper @if($colorKey == $key) circle-wrapper--active @endif" data-color="{{ $colorKey }}">
                                            <div class="circle" style="background-color: {{ $color->colorHEX }};"><i class="fa fa-check"></i></div><span>@if($colorKey == $key) {{ $color->name }} @endif</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="uk-position-bottom-left uk-position-small md_hidden">
                                <div class="stepper stepper--style-3 js-spinner card-stepper">
                                    <input autofocus type="number" min="3" max="99" step="1" value="3" class="stepper__input card-stepper__input quantity-field">
                                    <div class="stepper__controls">
                                        <button style="background-color: transparent; right: 18px;" type="button" spinner-button="up"><i class="fa fa-chevron-right"></i></button>
                                        <button style="background-color: transparent;" type="button" spinner-button="down"><i class="fa fa-chevron-left"></i></button>
                                    </div>
                                </div>
                                <p class="md_hidden" style="color: black;font-size: 16px;margin-bottom: 8px;">*Минимальное количество заказа: 3шт.</p>
                                <button class="card-slideshow__btn add-to-card-button" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>&nbsp; Добавить в корзину</button>
                            </div>
                            <div class="stepper stepper--style-3 js-spinner card-stepper md_visible">
                                <input autofocus type="number" min="3" max="99" step="1" value="3" class="stepper__input card-stepper__input">
                                <div class="stepper__controls">
                                    <button style="background-color: transparent; right: 18px;" type="button" spinner-button="up"><i class="fa fa-chevron-right"></i></button>
                                    <button style="background-color: transparent;" type="button" spinner-button="down"><i class="fa fa-chevron-left"></i></button>
                                </div>
                            </div>
                            <span class="md_visible" style="color: black;font-size: 14px;margin-bottom: 4px;">*Минимальное количество заказа: 3шт.</span>
                            <button class="card-slideshow__btn md_visible add-to-card-button" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>&nbsp; Добавить в корзину</button>
                        </div>
                    </div>
                @endif
            @endforeach

            <h2 class="card__title">{{ $product->title }}</h2>

            @if ($product->colors()->count() < 1 || !$product->hasAnyColorImages())
                    <div class="uk-position-bottom-left uk-position-small md_hidden">
                        <div class="stepper stepper--style-3 js-spinner card-stepper">
                            <input autofocus type="number" min="3" max="99" step="1" value="3" class="stepper__input card-stepper__input quantity-field">
                            <div class="stepper__controls">
                                <button style="background-color: transparent; right: 18px;" type="button" spinner-button="up"><i class="fa fa-chevron-right"></i></button>
                                <button style="background-color: transparent;" type="button" spinner-button="down"><i class="fa fa-chevron-left"></i></button>
                            </div>
                        </div>
                        <button class="card-slideshow__btn add-to-card-button" data-product-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>&nbsp; Добавить в корзину</button>
                    </div>
                    <div class="stepper stepper--style-3 js-spinner card-stepper md_visible">
                        <input autofocus type="number" min="3" max="99" step="1" value="3" class="stepper__input card-stepper__input">
                        <div class="stepper__controls">
                            <button style="background-color: transparent; right: 18px;" type="button" spinner-button="up"><i class="fa fa-chevron-right"></i></button>
                            <button style="background-color: transparent;" type="button" spinner-button="down"><i class="fa fa-chevron-left"></i></button>
                        </div>
                    </div>
                    <button class="card-slideshow__btn md_visible"><i class="fa fa-shopping-cart"></i>&nbsp; Добавить в корзину</button>
            @endif
        </div>
    </section>


    <section class="card-descr" id="card-descr">

        <div class="container">
            <h2 class="section-title">{{ number_format($product->price, 0, ',', ' ') }} RMB</h2>

            <div class="row">
                <div class="col-lg-6">
                    <h4 class="card-descr__title">Описание</h4>
                    <p class="card-descr__txt">{{ $product->description }}</p>
                </div>
                <div class="col-lg-6">
                    <h4 class="card-descr__title">Характеристики</h4>
                    <p class="card-descr__txt">
                        Тщательно разработанный в Швеции и изготовленный в Пфорцхайме, Германия, с использованием тщательно продуманных высококачественных компонентов. Механизм от всемирно известного швейцарского производителя Ronda и стальной корпус 316L, изготовленный с тщательным сочетанием полированной и шлифованной отделки.
                    </p>
                </div>
            </div>

        </div>
        @if ($product->hasSidesImages())
            <div class="promoBlock">
                <div class="promoBlock__wrapper">
                    <div class="promoBlock__images">
                        <div class="promoBlock__img" style="background-image: url('{{ $product->getLeftImage() }}')"></div>
                        <div class="promoBlock__img" style="background-image: url('{{ $product->getLeftImage() }}')"></div>
                        <div class="promoBlock__img promoBlock__img--active" style="background-image: url('{{ $product->getFrontImage() }}')"></div>
                        <div class="promoBlock__img" style="background-image: url('{{ $product->getRightImage() }}')"></div>
                        <div class="promoBlock__img" style="background-image: url('{{ $product->getRightImage() }}')"></div>
                    </div>
                    <div class="promoBlock__hoverFields">
                        <div class="promoBlock__field"></div>
                        <div class="promoBlock__field"></div>
                        <div class="promoBlock__field"></div>
                        <div class="promoBlock__field"></div>
                        <div class="promoBlock__field"></div>
                    </div>
                </div>
            </div>
        @endif

    </section>
    <input type="hidden" id="colorHex" value="@if ($product->colors()->count() > 0) {{ $product->colors()->first()->colorHEX }} @endif">
    <input type="hidden" id="colorName" value="@if ($product->colors()->count() > 0) {{ $product->colors()->first()->name }} @endif">
    @include('front.layouts.feedback')
@endsection

@section('js')
    <script>
        jQuery(function() {
            $('.add-to-card-button').on('click', function(e) {
                e.preventDefault();
                let element = $(this);
                let quantity = parseInt(element.prev().prev().find('.card-stepper__input').val());
                let productId = element.data('product-id');
                let colorHex = $('#colorHex').val();
                let colorName = $('#colorName').val();
                $.ajax({
                    url: '{{ route('cart.add') }}',
                    'method': 'post',
                    data: {_token: '{{ csrf_token() }}', productId, quantity: quantity, colorHex, colorName},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        })
    </script>
@endsection
