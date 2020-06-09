@extends('front.layouts.app')

@section('title', 'Спасибо за заказ')

@section('content')
<section id="confirm" class="confirm">
	
	<div class="container">
		<h2 class="page-title">Заказ подтверждён</h2>
		
		<div class="confirm-order">
			<div class="confirm-order__title">Спасибо за покупку!</div>
			<div class="confirm-order__num">
				Номер заказа: {{ $order->id }}
			</div>
			<div class="confirm-order__descr">
			Вы получите письмо на ваш адрес электронной почты (email) с подробной информацией о заказе.
			</div>
			<a href="{{ route('home') }}" class="confirm-order__btn">Вернуться к выбору товаров</a>
		</div>

	</div>

</section>
@include('front.layouts.feedback')
@endsection