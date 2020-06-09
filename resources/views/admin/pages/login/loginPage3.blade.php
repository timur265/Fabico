@extends('admin.layouts.login')

@section('content')
    <div id="page-container" class="main-content-boxed">
        <!-- Main Container -->
        <main id="main-container">
            <!-- Page Content -->
            <div class="bg-gd-dusk">
                <div class="hero-static content content-full bg-white invisible" data-toggle="appear">
                    <!-- Header -->
                    <div class="py-30 px-5 text-center">
                        <a class="link-effect font-w700" href="#">
                            <i class="si si-fire"></i>
                            <span class="font-size-xl text-primary-dark">Vid</span><span class="font-size-xl">Panel</span>
                        </a>
                        <h1 class="h3 font-w700 mt-30 mb-10">Добро пожаловать в админку!</h1>
                        <h2 class="h5 font-w400 text-muted mb-0">Пожалуйста войдите!</h2>
                    </div>
                    <!-- END Header -->

                    <!-- Sign In Form -->
                    <div class="row justify-content-center px-5">
                        <div class="col-sm-8 col-md-6 col-xl-4">
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.js) -->
                            <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{ route('admin.login') }}" method="post">
                                @csrf
                                <div class="form-group @error('email') is-invalid @enderror row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="text" class="form-control" id="login-username" name="email">
                                            <label for="login-username">Логин</label>
                                        </div>
                                        @error('email')
                                        <div id="val-email2-error" class="invalid-feedback animated fadeInDown">Нет такого пользователя.</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material floating">
                                            <input type="password" class="form-control" id="login-password" name="password">
                                            <label for="login-password">Пароль</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row gutters-tiny">
                                    <div class="col-12 mb-10">
                                        <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                                            <i class="si si-login mr-10"></i> Войти
                                        </button>
                                    </div>
                                    <div class="col-sm-6 mb-5">
                                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_signup.html">
                                            <i class="fa fa-plus text-muted mr-5"></i> Новый аккаунт
                                        </a>
                                    </div>
                                    <div class="col-sm-6 mb-5">
                                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="op_auth_reminder.html">
                                            <i class="fa fa-warning text-muted mr-5"></i> Забыл пароль
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Sign In Form -->
                </div>
            </div>
            <!-- END Page Content -->
        </main>
        <!-- END Main Container -->
    </div>

@endsection