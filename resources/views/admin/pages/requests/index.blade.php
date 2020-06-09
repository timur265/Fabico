@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/dataTables/datatables.min.css"/>
@endsection

@section('content')
    <h2 class="content-heading">Заявки на регистрацию</h2>
    <div class="row">
        <div class="col-12">
            <div class="block">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center">№</th>
                                    <th class="text-center">Имя</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Город</th>
                                    <th class="text-center">Подтверждён</th>
                                    <th class="text-center">Дата</th>
                                    <th class="text-center">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td class="text-center">{{ $request->id }}</td>
                                        <td class="text-center">{{ $request->company_name }}</td>
                                        <td class="text-center">{{ $request->user->email }}</td>
                                        <td class="text-center">{{ $request->city }}</td>
                                        <td class="text-center">@if($request->confirmed()) <i class="fa fa-check text-success"></i> @else <i class="fa fa-close text-danger"></i>  @endif</td>
                                        <td class="text-center">{{ $request->created_at }}</td>
                                        <td class="d-flex justify-content-center">
                                            @if (!$request->confirmed())
                                                <a href="{{ route('requests.confirm', $request->id) }}" class="btn btn-alt-primary btn-sm" data-toggle="tooltip" title=""><i class="fa fa-check"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
