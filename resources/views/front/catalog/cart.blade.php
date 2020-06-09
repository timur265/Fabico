@extends('front.layouts.app')

@section('title', 'Ваша корзина')

@section('content')
	<section class="cart" id="cart">
		<form action="{{ route('cart.order') }}" method="post" class="container">
            @csrf
			<div class="row">
                <div class="col-lg-8">
                    <div class="cart-goods">
                        <span class="cart-goods__title">Наименование</span>
                        <span class="cart-goods__quantity">Кол-во</span>
                        <hr style="background-color: #f7f7f7;">
                        @if (session('cart'))
                            @foreach(session('cart') as $id => $details)
                                <div class="cart-good">
                                    <div class="cart-good__img">
                                        <img src="{{ $details['photo'] }}" alt="">
                                    </div>
                                <span class="cart-good__title">{{ $details['name'] }}, <span style="color: {{ $details['colorHex'] }}">{{ $details['colorName'] }}</span></span>
                                    <input type="checkbox" class="cart-good__checkbox uk-checkbox"></input>
                                    <div class="stepper stepper--style-3 js-spinner card-good__quantity-wrapper">
                                        <input autofocus type="number" min="3" max="99" step="1" value="{{ $details['quantity'] }}" data-product-id="{{ $id }}" class="stepper__input cart-good__quantity__input">
                                        <div class="stepper__controls">
                                            <button class="cart-good__quantity__btn" type="button" spinner-button="up"><i class="fa fa-caret-right"></i></button>
                                            <button class="cart-good__quantity__btn" type="button" spinner-button="down"><i class="fa fa-caret-left"></i></button>
                                        </div>
                                    </div>
                                    <span class="cart-good_m">М</span>
                                    <button class="cart-good_delete" data-product-id="{{ $id }}"><span>Удалить</span><i class="fa fa-times"></i></button>
                                </div>
                            @endforeach
                        @endif
                        <div class="total">
                            Общая сумма: <span>@if (isset($cartTotalSum)) {{ number_format($cartTotalSum, 0, ',', ' ') }} @else 0 @endif RMB</span>
                        </div>
                        <div class="min_quan">
                            *Минимальное количество заказа: 3шт.
                        </div>
                    </div>
                    <div class="choose-req uk-form-horizontal uk-margin-medium-top">
                        <div class="uk-form-label choose-req__title">Способ заказа</div>
                        <div class="uk-form-controls uk-form-controls-text">
                            <label><input class="uk-checkbox uk-margin-small-right" id="makeContractCheckbox" type="checkbox" name="makeContract">Выставить договор</label>
                        </div>
                    </div>
                    <div class="new-req-form" id="requisitesForm" style="display: none">
                        <div class="new-req-form__textarea">
                            <label class="new-req-form__label" for="new-req-form-client">Заказчик:</label>
                            <textarea class="new-req-form__txtarea" name="company_name" id="" cols="45" rows="6" placeholder="Полное название компании">{{ old('company_name') }}</textarea>
                        </div>
                        <div class="new-req-form__textarea">
                            <label class="new-req-form__label" for="new-req-form-bank">Банк:</label>
                            <textarea class="new-req-form__txtarea" name="bank" id="" cols="45" rows="6" placeholder="Полный адрес">{{ old('bank') }}</textarea>
                        </div>
                        <div class="new-req-form__textarea">
                            <label class="new-req-form__label" for="new-req-form-address">Адрес:</label>
                            <textarea class="new-req-form__txtarea" name="address" id="" cols="45" rows="6" placeholder="Полный адрес">{{ old('address') }}</textarea>
                        </div>
                        <div class="new-req-form__inputs">
                            <label class="new-req-form__label" for="new-req-form-inn">ИНН:</label>
                            <input class="new-req-form__input" type="text" name="tin" value="{{ old('tin') }}">
                        </div>
                        <div class="new-req-form__inputs">
                            <label class="new-req-form__label" for="new-req-form-oked">ОКЕД:</label>
                            <input class="new-req-form__input" type="text" name="ctea" value="{{ old('ctea') }}">
                        </div>
                        <div class="new-req-form__inputs">
                            <label class="new-req-form__label" for="new-req-form-mfo">МФО:</label>
                            <input class="new-req-form__input" type="text" name="mfi" value="{{ old('mfi') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 cart-aside">
                    <p class="cart-aside__txt">*Не весь товар бывает в наличии на складе, оставьте контактный телефон, либо вы можете связаться с офисом для уточнения наличия товара</p>
                    <div class="cart-aside-form">
                        <label for="cart-name" class="cart-aside-form__label">Имя</label>
                        <input name="name" type="text" required class="cart-aside-form__input" value="{{ old('name') }}">
                        <label for="cart-tel" class="cart-aside-form__label">Телефон</label>
                        <input name="phone_number" required type="tel" class="cart-aside-form__input" value="{{ old('phone_number') }}">
                        <label for="cart-email" class="cart-aside-form__label">Почта</label>
                        <input name="email" type="email" class="cart-aside-form__input" value="@if (auth()->user()) {{ old('email') ?? auth()->user()->email }} @else {{ old('email') }} @endif">
                        <label for="cart-comment" class="cart-aside-form__label">Комментарий</label>
                        <textarea name="comment" id="" cols="30" rows="10" class="cart-aside-form__txtarea">{{ old('comment') }}</textarea>
                    </div>
                    <button type="submit" class="cart-aside-form__btn btn-submit"><i class="fa fa-envelope"></i>Отправить</button>
                </div>
			</div>
            @auth <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> @endauth
		</form>
	</section>
@endsection
@section('js')

    <script>
        jQuery(function () {
            $('.cart-good_delete').on('click', function (e) {
                e.preventDefault();
                let productId = $(this).data('product-id');
                if (confirm('Вы уверены?')) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: 'post',
                        data: {_token: '{{ csrf_token() }}', productId},
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
            $('.cart-good__quantity__input').on('change', function (e) {
                e.preventDefault();
                let productId = $(this).data('productId');
                let quantity = $(this).val();
                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'post',
                    data: {_token: '{{ csrf_token() }}', productId, quantity},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>

    <script>
        jQuery(function() {
            jQuery('#makeContractCheckbox').on('change', function(event) {
                if (this.checked) {
                    jQuery('#requisitesForm').css('display', 'block');
                } else {
                    jQuery('#requisitesForm').css('display', 'none');
                }
            })
        });
    </script>
@endsection
