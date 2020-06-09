@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="/dataTables/datatables.min.css"/>
@endsection
@section('content')
    <h2 class="content-heading">
        Все пользователи
    </h2>
    <div class="row">
        <div class="col-md-12"><div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Пользователи</h3>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                        Создать
                    </a>
                </div>
                <div class="block-content">
                    <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th class="text-center d-none d-md-none d-lg-table-cell" style="width: 50px;">ID</th>
                            <th class="text-center d-none d-md-none d-lg-table-cell" style="width: 50px;"><i class="si si-picture"></i></th>
                            <th>Имя</th>
                            <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                            <th class="d-none d-md-table-cell" style="width: 15%;">Роль</th>
                            <th class="d-none d-md-table-cell">Подтверждён</th>
                            <th class="d-none d-md-table-cell">Заявка</th>
                            <th class="text-center" style="width: 100px;">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- Нужно что нибудь придумать с использованием инкрементации в шабллонах, т.к. думаю это неправильно --}}
                        <?php $i = 10; ?>
                        @foreach($users as $user)
                            <tr>
                                <td class="font-w600 text-center">{{ $user->id }}</td>
                                <td width="50" class="text-center d-none d-md-none d-lg-table-cell">
                                    <img class="img-avatar img-avatar48" src="{{ $user->getImage() }}" alt="">
                                </td>
                                <td class="font-w600">{{ $user->name }}</td>
                                <td class="d-none d-sm-table-cell">{{ $user->email }}</td>
                                <td class="d-none d-md-table-cell">
                                    @foreach ($user->roles as $role)
                                        <span class="badge badge-primary">{{ $role->description }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">@if($user->confirmed) <i class="fa fa-check text-success"></i> @else <i class="fa fa-close text-danger"></i>  @endif</td>
                                <td class="d-flex justify-content-center">
                                    @if ($user->registrationRequest)
                                        <a href="{{ route('requests.show', $user->registrationRequest->id) }}" class="btn btn-sm btn-alt-primary d-flex align-items-center" data-toggle="tooltip" title="Показать"><i class="fa fa-eye"></i></a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('users.edit', [$user->id, 'list_id' => intval($i/10)]) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @if(!$user->hasRole('admin'))
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button class="btn btn-sm btn-secondary" onclick="return confirm('Вы уверены?');">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="/dataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
                },
                'order': []
            });
            setTimeout(function () {
                @if(isset($_GET['list_id']))
                $.each($('.page-link '), function (index, value) {
                    if($(value).data('dt-idx') == {{ $_GET['list_id'] }}){
                        console.log($('.paginate_button')[index + 1]);
                        $('.paginate_button').eq(index).addClass('active');
                    }else{
                        $('.paginate_button').eq(index).removeClass('active');
                    }
                });
                @endif
            }, 500);


        } );
    </script>
@endsection
