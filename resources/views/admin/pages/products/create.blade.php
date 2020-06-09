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
        .gallery > img {
            margin-top: 15px!important;
        }
        .delete-button {
            cursor: pointer;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
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
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class=" block">
                    <div class="block-header">
                        <h3 class="block-title">Информация</h3>
                        <div class="block-options">
                            <button type="submit" class="btn btn-alt-success"><i class="fa fa-check"></i> Сохранить</button>
                        </div>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="form-group">
                            <div class="form-material floating">
                                <input class="form-control" type="text" id="ru_title" name="ru_title" value="{{ old('ru_title') }}">
                                <label for="ru_title">Название</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-material">
                                <textarea class="form-control" id="ru_description" name="ru_description">{{ old('ru_description') }}</textarea>
                                <label for="ru_description">Описание</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-material floating">
                                <input class="form-control" type="number" id="price" name="price" value="{{ old('price') }}">
                                <label for="price">Цена</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-material floating">
                                <select class="form-control" id="material-select2" name="category_id">
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
                        </div>
                        <div class="form-group">
                            <div class="form-material floating">
                                <select class="form-control" id="material-select2" name="brand_id">
                                    <option value="0" selected>-- нет --</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="material-select2">Бренд продукта</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="css-control css-control-primary css-checkbox"><input type="checkbox" class="css-control-input" name="is_auth" checked><span class="css-control-indicator"></span>Приватный товар</label>
                        </div>
                        <h4 class="content-heading">Характеристики</h4>
                        <button id="addParamsButton" type="button" class="btn btn-alt-primary"><i class="fa fa-plus"></i> Добавить</button>
                        <div id="paramsItems">

                        </div>

                        <!-- END Step 3 -->
                    </div>

                    <!-- END Steps Content -->
                    <!-- END Form -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4">
                <div class="block block-themed">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Изображение слева</h3>
                    </div>
                    <div class="block-content block-content block-content-full text-center bg-info-lighter">
                        <img id="leftBlah" src="#" alt="your image" style="display: none;"/>
                        <div class="input_file">
                            <div class="remove" style="display: none;">Удалить</div>
                            <input id="leftImgInp" accept="image/*" type="file" class="form-control input_file__input" name="left_image">
                            <div class="input_file__text">
                                <div class="input_file_text_first select">Выбрать</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="block block-themed">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Изображение прямо</h3>
                    </div>
                    <div class="block-content block-content block-content-full text-center bg-info-lighter">
                        <img id="frontBlah" src="#" alt="your image" style="display: none;"/>
                        <div class="input_file">
                            <div class="remove" style="display: none;">Удалить</div>
                            <input id="frontImgInp" accept="image/*" type="file" class="form-control input_file__input" name="front_image">
                            <div class="input_file__text">
                                <div class="input_file_text_first select">Выбрать</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="block block-themed">
                    <div class="block-header bg-primary">
                        <h3 class="block-title">Изображение справа</h3>
                    </div>
                    <div class="block-content block-content block-content-full text-center bg-info-lighter">
                        <img id="rightBlah" src="#" alt="your image" style="display: none;"/>
                        <div class="input_file">
                            <div class="remove" style="display: none;">Удалить</div>
                            <input id="rightImgInp" accept="image/*" type="file" class="form-control input_file__input" name="right_image">
                            <div class="input_file__text">
                                <div class="input_file_text_first select">Выбрать</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="block block-themed">
                    <div class="block-header bg-primary">
                        <h3 class="block-title text-center">Картинка-превью</h3>
                    </div>
                    <div class="block-content block-content-full text-center bg-info-lighter">
                        <img id="blah" src="#" alt="your image" style="display: none;"/>
                        <div class="input_file">
                            <div class="remove" style="display: none;">Удалить</div>
                            <input id="imgInp" accept="image/*" type="file" class="form-control input_file__input" name="preview_image">
                            <div class="input_file__text">
                                <div class="input_file_text_first select">Выбрать</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="block">
                    <div class="block-header">
                        <h3 class="block-title">Цвета и изображения</h3>
                        <div class="block-options">
                            <button class="btn btn-sm btn-alt-primary" type="button" id="addColorButton"><i class="fa fa-plus"></i> Добавить</button>
                        </div>
                    </div>
                    <div class="block-content" id="color-items">

                    </div>
                </div>
            </div>
        </div>
    </form>

    <template id="color-item-template">
        <div class="block block-themed color-item" id="color-item-{0}">
            <div class="block-header bg-primary-light">
                <h3 class="block-title">Цвет товара</h3>
                <div class="block-options">
                    <button class="btn-block-option delete-button" type="button" data-toggle="tooltip" title="Удалить цвет" data-block-id="color-item-{0}"><i class="fa fa-trash"></i></button>
                </div>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="colorName{0}">Название</label>
                            <input type="text" name="colors[{0}][name]" class="form-control" id="colorName{0}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label class="col-12" for="colorHex{0}">Цвет</label>
                            <div class="col-12">
                                <div class="js-colorpicker input-group">
                                    <input type="text" class="form-control" name="colors[{0}][hex]" id="colorHex{0}">
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title text-center">Изображения</h3>
                            </div>
                            <div class="block-content block-content-full text-center bg-info-lighter">
                                <div class="input_file">
                                    <div class="remove" style="display: none;">Удалить</div>
                                    <input multiple accept="image/*" type="file" class="form-control input_file__input gallery-photo-add" data-gallery-id="gallery{0}" name="color-images-{0}[]">
                                    <div class="input_file__text">
                                        <div class="input_file_text_first select">Выбрать</div>
                                    </div>
                                </div>
                            </div>
                            <div style="text-align:center;" id="gallery{0}" class="gallery"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <template id="productParamTemplate">
        <div class="row" id="param-item-{0}">
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label for="paramsName{0}">Наименование</label>
                    <input type="text" name="params[{0}][name]" id="paramsName{0}" class="form-control">
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="form-group">
                    <label for="paramsValue{0}">Значение</label>
                    <input type="text" name="params[{0}][value]" id="paramsValue{0}" class="form-control">
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <button class="btn btn-sm btn-alt-danger mt-30 param-delete-button" type="button" data-param-id="{0}"><i class="fa fa-trash"></i> Удалить</button>
            </div>
        </div>
    </template>
@endsection


@section('js')
    <script>
        $(document).ready(function(){


            $('.add-form').click(function (e) {
                e.preventDefault();
                counter++;
                let charTitle = "<div class='row char-elem" + counter + "' style='margin-bottom: 10px;'>";
                charTitle += "<div class='col-md-3'><input name='charTitle[]' class='form-control char-title' type='text' placeholder='Введите название для характеристики...'></div>";
                charTitle += "<div class='col-md-3'><input name='charValue[]' class='form-control char-value' type='text' placeholder='Введите значение для характеристики...'></div>";
                charTitle += "<div class='col-md-3'><span class=' form-control btn btn-primary char-btn' onclick='removeBlock(" + counter + ")'> Удалить </span></div>";
                charTitle += "</div>";
                $('.char-content').append(charTitle);
            });


            function removeBlock(counter) {
                $('.char-elem' + counter).remove();
            }
            var counter = 0;

            function readURL(input, id) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(id).attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function() {
                readURL(this, '#blah');
                $('#blah').attr('style', 'display: block;width:200px;');
            });
            $("#leftImgInp").change(function() {
                readURL(this, '#leftBlah');
                $('#leftBlah').attr('style', 'display: block;width:200px;');
            });
            $("#rightImgInp").change(function() {
                readURL(this, '#rightBlah');
                $('#rightBlah').attr('style', 'display: block;width:200px;');
            });
            $("#frontImgInp").change(function() {
                readURL(this, '#frontBlah');
                $('#frontBlah').attr('style', 'display: block;width:200px;');
            });
        });

    </script>
    <script src="{{ asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        jQuery(function () {
            Codebase.helper('colorpicker');
        })
    </script>
    <script>
        if (!String.prototype.format) {
            String.prototype.format = function() {
                var args = arguments;
                return this.replace(/{(\d+)}/g, function(match, number) {
                    return typeof args[number] != 'undefined'
                        ? args[number]
                        : match
                        ;
                });
            };
        }

        function deleteColorItem() {
            let deleteButton = $(this);
            let blockId = deleteButton.data('block-id');
            $(`#${blockId}`).remove();
        }

        // Multiple images preview in browser
        function imagesPreview(input, placeToInsertImagePreview) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img style="width: 200px;">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                    };

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        jQuery(function() {
            let counter = 0;
            let templateString = $('#color-item-template').html();
            $('#addColorButton').on('click', function() {
                counter++;
                let colorItemString = templateString.format(counter);
                let colorItem = $(colorItemString);
                colorItem.find('.delete-button').on('click', deleteColorItem);
                colorItem.find('.gallery-photo-add').on('change', function() {
                    let galleryId = $(this).data('gallery-id');
                    imagesPreview(this, `div#${galleryId}`);
                });
                $('#color-items').append(colorItem);
                $([document.documentElement, document.body]).animate({
                    scrollTop: $(`#color-item-${counter}`).offset().top
                }, 1000);
                Codebase.helper('colorpicker');
            });
            $('.delete-button').on('click', deleteColorItem);
        })
    </script>
    <script>

        function deleteParamsItem() {
            let deleteButton = $(this);
            let blockId = deleteButton.data('param-id');
            $(`#param-item-${blockId}`).remove()
        }

        jQuery(function () {
            let counter = 0;
            let templateString = $('#productParamTemplate').html();
            $('#addParamsButton').on('click', function() {
                counter++;
                let paramsItemString = templateString.format(counter);
                let paramsItem = $(paramsItemString);
                $('#paramsItems').append(paramsItem);
                paramsItem.find('.param-delete-button').on('click', deleteParamsItem);
            })
        })
    </script>
@endsection
