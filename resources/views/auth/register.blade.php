@extends('front.layouts.app')

@section('title', 'Регистрация')

@section('content')
<section class="form" id="form">
	<legend class="form__title">Создание аккаунта</legend>
	<form action="#" class="form-login" method="post">
		@csrf
		<label class="form-login__label" for="login-email">Имя</label>
		<input class="form-login__input" type="text" name="company_name" required="">
		<label class="form-login__label" for="login-email">Email</label>
		<input class="form-login__input" type="email" name="email" placeholder="companyname@gmail.com" required="">
		<label class="form-login__label" for="login-email">Город</label>
		<input class="form-login__input" type="text" name="city" required="">
		<label class="form-login__label" for="login-password">Пароль</label>
		<input class="form-login__input" type="password" name="password" placeholder="Как минимум 8 символов" required="">
		<label class="form-login__label" for="login-password">Подтвердите пароль</label>
		<input class="form-login__input" type="password" name="password_confirmation" placeholder="Пароли должны совпадать" required="">
		<button class="form-login__btn">Создать аккаунт</button>
	</form>
</section>
@endsection
