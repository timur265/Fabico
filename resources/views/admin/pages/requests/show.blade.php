@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Заявка № {{ $request->id }}</h3>
                    <div class="block-options">
                        @if (!$request->confirmed())
                            <a href="{{ route('requests.confirm', $request->id) }}" class="btn btn-alt-primary btn-sm"><i class="fa fa-check"></i> Подтвердить</a>
                        @endif
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h5 class="font-w600">Заказчик</h5>
                            <p>{{ $request->company_name }}</p>
                            <h5 class="font-w600">Адрес</h5>
                            <p>{{ $request->address }}</p>
                            <h5 class="font-w600">Email</h5>
                            <p>{{ $request->user->email }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h5 class="font-w600">Банк</h5>
                            <p>{{ $request->bank }}</p>
                            <h5 class="font-w600">ИНН</h5>
                            <p>{{ $request->tin }}</p>
                            <h5 class="font-w600">ОКЭД</h5>
                            <p>{{ $request->ctea }}</p>
                            <h5 class="font-w600">МФО</h5>
                            <p>{{ $request->mfi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
