@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Все товары
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li><a href="/admin/product">Все товары</a></li>
                <li class="active">Добавление товара</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box form-add-goods">
                        <form action="/admin/product/create" method="post" role="form" enctype="multipart/form-data">
                            <!-- TAB NAVIGATION -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Основные</a></li>
                                <li><a href="#tab2" role="tab" data-toggle="tab">SEO настройка</a></li>
{{--                                <li><a href="#tab3" role="tab" data-toggle="tab">Дополнительные поля</a></li>--}}
                                <li><a href="#tab4" role="tab" data-toggle="tab">Доступность</a></li>
                            </ul>
                            <!-- TAB CONTENT -->
                            <div class="tab-content">
                                <div class="active tab-pane fade in" id="tab1">
                                    <div class="form-group">
                                        <label for="namegoods">Наименование товара</label>
                                        <input type="text" class="form-control" name="namegoods" id="namegoods"
                                               placeholder="Введите название товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="sluggoods">Символьный код</label>
                                        <input type="text" class="form-control" name="sluggoods" id="sluggoods"
                                               placeholder="Введите символьный код товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="articulegoods">Артикул товара</label>
                                        <input type="text" class="form-control" name="articulegoods" id="articulegoods"
                                               placeholder="Введите артикул товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="categorygoods">Категория товара</label>
                                        <input type="text" class="form-control" name="categorygoods" id="categorygoods"
                                               placeholder="Введите артикул товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="pricegoods">Цена</label>
                                        <input type="number" class="form-control" name="pricegoods" id="pricegoods"
                                               placeholder="Введите цену товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Текст для товара</label>
                                        <input type="text" class="form-control" name="body" id="body"
                                               placeholder="Введите артикул товара">
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file">
                                            Анонс изображение товара
                                            <input type="file" id="file" class="custom-file-input" name="imageanons">
                                            <span class="custom-file-control"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file">
                                            Подробное изображение товара
                                            <input type="file" id="file" class="custom-file-input" name="imagedetail">
                                            <span class="custom-file-control"></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="form-group">
                                        <label for="seotitlegoods">Заголовок страницы</label>
                                        <input type="text" class="form-control" name="seotitlegoods" id="seotitlegoods"
                                               placeholder="Введите заголовок товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="seokeywordgoods">Ключевые слова</label>
                                        <input type="text" class="form-control" name="seokeywordgoods"
                                               id="seokeywordgoods"
                                               placeholder="Введите ключевые слова товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="seodescriptiongoods">Описание страницы (Description)</label>
                                        <input type="text" class="form-control" name="seodescriptiongoods"
                                               id="seodescriptiongoods"
                                               placeholder="Введите описание">
                                    </div>
                                </div>
{{--                                <div class="tab-pane fade" id="tab3">--}}
{{--                                    Пока в разработке--}}
{{--                                </div>--}}
                                <div class="tab-pane fade" id="tab4">
                                    <div class="form-group">
                                        <label for="statusgoods">Статус товара</label>
                                        <select name="statusgoods" id="statusgoods" class="form-control">
                                            <option value="published">Опубликован</option>
                                            <option value="testgoods">Черновик</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success">Отправить</button>
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
