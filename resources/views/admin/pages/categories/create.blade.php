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
    <h2 class="content-heading">Создание</h2>
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
    <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="block block-themed">
                    <div class="block-header bg-info">
                        <h3 class="block-title">Изображение</h3>
                    </div>
                    <div class="block-content block-content-full text-center bg-info-lighter">
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
                <div class="js-wizard-simple block">
                    <!-- Step Tabs -->
                    <ul class="nav nav-tabs nav-tabs-alt nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" href="#wizard-simple2-step1" data-toggle="tab">1. Рус</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#wizard-simple2-step2" data-toggle="tab">2. Eng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#wizard-simple2-step3" data-toggle="tab">3. Uzb</a>
                        </li>
                    </ul>
                    <!-- END Step Tabs -->

                    <!-- Form -->
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content" style="min-height: 267px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-simple2-step1" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="ru_title" name="ru_title" value="{{ old('ru_title') }}">
                                    <label for="ru_title">Заголовок</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material">
                                    <textarea class="form-control" id="ru_description" name="ru_description">{{ old('ru_description') }}</textarea>
                                    <label for="ru_description">Описание</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-simple2-step2" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="en_title" name="en_title" value="{{ old('en_title') }}">
                                    <label for="en_title">Заголовок</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material">
                                    <textarea class="form-control" id="en_description" name="en_description">{{ old('en_description') }}</textarea>
                                    <label for="en_description">Описание</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-simple2-step3" role="tabpanel">
                            <div class="form-group">
                                <div class="form-material floating">
                                    <input class="form-control" type="text" id="uz_title" name="uz_title" value="{{ old('uz_title') }}">
                                    <label for="uz_title">Заголовок</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-material">
                                    <textarea class="form-control" id="uz_description" name="uz_description">{{ old('uz_description') }}</textarea>
                                    <label for="uz_description">Описание</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-material floating">
                            <select class="form-control" id="material-select2" name="parent_id">
                                <option value="0" selected>-- нет --</option>
                                @foreach($categories as $category_list)
                                    <option value="{{ $category_list->id }}">{{ $category_list->ru_title }}</option>
                                    @if($category_list->hasChildren())
                                        @include('admin.pages.categories.components.categories', ['dilimiter' => '---', 'category' => $category_list])
                                    @endif
                                @endforeach
                            </select>
                            <label for="material-select2">Родительская категория</label>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->
                    <!-- END Form -->
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="block pb-3">
                    <div class="block-content text-right">
                        <button class="btn btn-info">Создать</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('js')

    <script src="/plugins/ckeditor/ckeditor.js"></script>
    <script src="/plugins/ckfinder/ckfinder.js"></script>

    <script>
        $(document).ready(function(){
            var editor = CKEDITOR.replaceAll();
            CKFinder.setupCKEditor( editor );
            w        });
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