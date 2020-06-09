@extends('admin.layouts.app')

@section('css')
    <style>
        .show-password{
            cursor: pointer;
        }
        .save_button{
            position: absolute;
            top: 85%;
            right: 3%;
        }
        .input_file{
            border: 1px solid #26c6da;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
            position: relative;
            color: #26c6da;
        }
        .input_file__text{
            overflow: hidden;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 3px;
            padding-bottom: 3px;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 15px;
        }
        .input_file__input{
            position: absolute;
            opacity: 0;
            z-index: 2;
        }
        .remove{
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 35%;
            text-align: right;
            padding-right: 10px;
            padding-top: 3px;
            z-index: 3;
            cursor: pointer;
            background-color: #26c6da;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <!-- Material Design -->
    <h2 class="content-heading">Редактирование</h2>
    @if($errors->any())
        <div class="row">
            <div class="col-md-12 mb-3">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="hidden" name="list_id" value="{{ $_GET['list_id'] }}">
        <div class="row">
            <div class="col-md-3">
                <div class="block block-themed">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Аватар</h3>
                        {{--<div class="block-options">--}}
                        {{--<button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">--}}
                        {{--<i class="si si-refresh"></i>--}}
                        {{--</button>--}}
                        {{--<button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>--}}
                        {{--</div>--}}
                    </div>
                    <div class="block-content block-content-full text-center bg-info-lighter">
                        <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ $user->getImage() }}" alt="">
                        <div class="input_file">
                            <div class="remove" style="display: none;">Удалить</div>
                            <input type="file" class="form-control input_file__input" name="image">
                            <div class="input_file__text">
                                <div class="input_file_text_first select">Выбрать</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Floating Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Основные</h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material floating">
                                    <input type="text" class="form-control" id="material-text2" name="name" value="{{ $user->name }}">
                                    <label for="material-text2">Логин</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input disabled="" type="email" class="form-control" id="material-email2" name="" value="{{ $user->email }}">
                                    <label for="material-email2">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Роль</label>
                            <select name="role_id" id="" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- END Floating Labels -->
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="block pb-3">
                    <div class="block-content text-right">
                        <button class="btn btn-info">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="{{ route('users.change.password', $user->id) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="list_id" value="{{ $_GET['list_id'] }}">
        <div class="row">
            <div class="col-md-12">
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Изменение пароля</h3>
                    </div>
                    <div class="block-content">
                        @if(session('password_confirmation_error') || session('password_success') || session('password_error'))
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <ul class="list-group">
                                        @if(session('password_confirmation_error')) <li class="list-group-item list-group-item-danger">{{ session('password_confirmation_error') ?? '' }}</li> @endif
                                        @if(session('password_success')) <li class="list-group-item list-group-item-success">{{ session('password_success') ?? '' }}</li> @endif
                                        @if(session('password_error')) <li class="list-group-item list-group-item-danger">{{ session('password_error') ?? '' }}</li> @endif
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-material floating input-group">
                                    <input type="password" class="form-control" id="password" name="oldPassword">
                                    <label for="material-addon-icon2">Старый пароль</label>
                                    <span class="input-group-addon show-password" data-id="password">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating input-group">
                                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                                    <label for="material-addon-icon2">Новый пароль</label>
                                    <span class="input-group-addon show-password" data-id="newPassword">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating input-group">
                                    <input type="password" class="form-control" id="confPassword" name="confPassword">
                                    <label for="material-addon-icon2">Подтверждение</label>
                                    <span class="input-group-addon show-password" data-id="confPassword">
                                        <i class="fa fa-fw fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary">Сохранить пароль</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('js')

    <script>
        $('.input_file__input').change(function (e) {
            $('.select').text(e.target.files[0].name);
            $('.remove').attr('style', 'display: block;')
        });
        $('.remove').click(function (e) {
            $('.input_file__input').val('');
            $(this).attr('style', 'display: none;');
            $('.select').text('Выбрать');
        })
        $('.show-password').click(function () {
            var id = $(this).data('id');
            var el = $('#' + id);
            if(el.attr('type') == 'password'){
                $('#' + id).attr('type', 'text');
            }else {
                $('#' + id).attr('type', 'password');
            }
        });
    </script>

@endsection
