@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Создание магазина
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li><a href="/admin/product">Все магазины</a></li>
                <li class="active">Добавление магазина</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box form-add-goods">
                        <form action="" method="post" role="form">
                            <!-- TAB NAVIGATION -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Основные</a></li>
                                <li><a href="#tab2" role="tab" data-toggle="tab">ГЕО положение</a></li>
                                <li><a href="#tab3" role="tab" data-toggle="tab">Дополнительные поля</a></li>
                                <li><a href="#tab4" role="tab" data-toggle="tab">Доступность</a></li>
                            </ul>
                            <!-- TAB CONTENT -->
                            <div class="tab-content">
                                <div class="active tab-pane fade in" id="tab1">
                                    <div class="form-group">
                                        <label for="namestore">Наименование магазина</label>
                                        <input type="text" class="form-control" name="namestore" id="namestore"
                                               placeholder="Введите название товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="slugstore">Символьный код</label>
                                        <input type="text" class="form-control" name="slugstore" id="slugstore"
                                               placeholder="Введите символьный код товара">
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file">
                                            Изображение магазина
                                            <input type="file" id="file" class="custom-file-input">
                                            <span class="custom-file-control"></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="form-group">
                                        <label for="adressstore">Адрес магазина</label>
                                        <input type="text" class="form-control" name="adressstore" id="adressstore"
                                               placeholder="Введите символьный код товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="coordstore">Коориднаты для карты</label>
                                        <input type="text" class="form-control" name="coordstore" id="coordstore"
                                               placeholder="Введите символьный код товара">
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    Пока в разработке
                                </div>
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

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
