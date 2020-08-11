@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Создание статьи
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li><a href="/admin/pages">Все статьи</a></li>
                <li class="active">Добавление статьи</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box form-add-goods">
                        <form action="" method="post" role="form" enctype="multipart/form-data">
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
                                        <label for="namepages">Наименование статьи</label>
                                        <input type="text" class="form-control" name="namepages" id="namepages"
                                               placeholder="Введите название товара">
                                    </div>
                                    <div class="form-group">
                                        <label for="slugpages">Символьный код</label>
                                        <input type="text" class="form-control" name="slugpages" id="slugpages"
                                               placeholder="Введите символьный код статьи">
                                    </div>
                                    <div class="form-group">
                                        <label for="anonspages">Анонс статьи</label>
                                        <input type="text" class="form-control" name="anonspages" id="anonspages"
                                               placeholder="Введите краткое описание статьи">
                                    </div>
                                    <div class="form-group">
                                        <label for="articulegoods">Контент для статьи</label>
                                        <textarea name="post_body"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file">
                                            Изображение статьи
                                            <input type="file" id="file" name="imagepost" class="custom-file-input">
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
                                        <label for="statusgoods">Статус страницы</label>
                                        <select name="statusgoods" id="statusgoods" class="form-control">
                                            <option value="published">Опубликован</option>
                                            <option value="testgoods">Черновик</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-success">Отправить</button>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
