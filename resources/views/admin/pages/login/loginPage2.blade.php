@extends('admin.layouts.login')

@section('content')

    <div id="page-container" class="main-content-boxed">
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-body-dark bg-pattern" style="background-image: url('{{ asset('assets/img/various/bg-pattern-inverse.png') }}');">
                <div class="row mx-0 justify-content-center">
                    <div class="hero-static col-lg-6 col-xl-4">
                        <div class="content content-full overflow-hidden">
                            <!-- Header -->
                            <div class="py-30 text-center">
                                <a class="link-effect font-w700" href="index.html">
                                    <i class="si si-fire"></i>
                                    <span class="font-size-xl text-primary-dark">Vid</span><span class="font-size-xl">Panel</span>
                                </a>
                                <h1 class="h3 font-w700 mt-30 mb-10">Добро пожаловать в админку!</h1>
                                <h2 class="h5 font-w400 text-muted mb-0">Пожалуйста войдите!</h2>
                            </div>
                            <!-- END Header -->

                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{ route('admin.login') }}" method="post">
                                @csrf
                                <div class="block block-themed block-rounded block-shadow">
                                    <div class="block-header bg-gd-dusk">
                                        <h3 class="block-title">Пожалуйста войдите!</h3>
                                        <div class="block-options">
                                            <button type="button" class="btn-block-option">
                                                <i class="si si-wrench"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group @error('email') is-invalid @enderror row">
                                            <div class="col-12">
                                                <label for="login-username">Логин</label>
                                                <input type="text" class="form-control" id="login-username" name="email">
                                            </div>
                                            @error('email')
                                            <div id="val-email2-error" class="invalid-feedback animated fadeInDown">Нет такого пользователя.</div>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="login-password">Пароль</label>
                                                <input type="password" class="form-control" id="login-password" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <div class="col-sm-6 d-sm-flex align-items-center push">
                                                <label class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                                    <input type="checkbox" class="custom-control-input" id="login-remember-me" name="remember-me">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Запомнить меня</span>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 text-sm-right push">
                                                <button type="submit" class="btn btn-alt-primary">
                                                    <i class="si si-login mr-10"></i> Войти
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-content bg-body-light">
                                        <div class="form-group text-center">
                                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="op_auth_signup3.html">
                                                <i class="fa fa-plus mr-5"></i> Создать аккаунт
                                            </a>
                                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="op_auth_reminder3.html">
                                                <i class="fa fa-warning mr-5"></i> Забыл пароль
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>

@endsection