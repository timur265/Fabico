@extends('admin.layouts.app')

@section('content')
    <h2 class="content-heading">Обратная связь</h2>

    <div class="block">
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center font-w600">Имя</th>
                            <th class="text-center font-w600">Email</th>
                            <th class="text-center font-w600">Номер телефона</th>
                            <th class="text-center font-w600">Вопрос</th>
                            <th class="text-center font-w600">Дата</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="text-center">{{ $feedback->name }}</td>
                                <td class="text-center"> @if($feedback->email) {{ $feedback->email }} @else - @endif</td>
                                <td class="text-center">{{ $feedback->phone_number }}</td>
                                <td class="text-center" style="word-break: break-all; max-width: 350px;"> @if ($feedback->question) <p>{{ $feedback->question }}</p> @else - @endif </td>
                                <td class="text-center">{{ $feedback->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
