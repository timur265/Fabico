@extends('front.layouts.app')

@section('content')
<section class="req" id="req">
	<div class="container">
		<h2 class="page-title">Введите реквизиты</h2>
		<form action="" method="post" class="req-form">
            @csrf
			<div class="row">
				<div class="col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-12">
					<label class="req-form__label" for="req-form-client">Заказчик:</label>
					<textarea class="req-form__txtarea" name="company_name" id="req-form-client" cols="45" rows="6" placeholder="Полное название компании" required="">{{ old('client') }}</textarea>
				</div>
				<div class="col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-12">
					<label class="req-form__label" for="req-form-bank">Банк:</label>
					<textarea class="req-form__txtarea" name="bank" id="req-form-bank" cols="45" rows="6" placeholder="Полный адрес" required="">{{ old('bank') }}</textarea>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-12">
					<label class="req-form__label" for="req-form-address">Адрес:</label>
					<textarea class="req-form__txtarea" name="address" id="req-form-address" cols="45" rows="6" placeholder="Полный адрес" required="">{{ old('address') }}</textarea>
				</div>
				<div class="col-md-6 offset-md-0 col-sm-10 offset-sm-1 col-12">
					<div class="flexible">
						<label class="req-form__label" for="req-form-inn">ИНН:</label>
						<input class="req-form__input" type="text" name="tin" id="req-form-inn" required="" value="{{ old('inn') }}">
					</div>
					<div class="flexible">
						<label class="req-form__label" for="req-form-oked">ОКЕД:</label>
						<input class="req-form__input" type="text" name="ctea" id="req-form-oked" required="" value="{{ old('oked') }}">
					</div>
					<div class="flexible">
						<label class="req-form__label" for="req-form-mfo">МФО:</label>
						<input class="req-form__input" type="text" name="mfi" id="req-form-mfo" required="" value="{{ old('mfo') }}">
					</div>
				</div>
			</div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
			<button class="req-form__btn btn-submit" type="submit"><i class="fa fa-envelope"></i>Отправить</button>
		</form>
	</div>

</section>
@endsection
