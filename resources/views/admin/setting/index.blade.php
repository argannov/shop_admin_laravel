@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Настройки сайта
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li><a href="/admin/setting">Настройки</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box form-add-goods">
                        <form action="/admin/sale/create" method="post" role="form">
                            <!-- TAB NAVIGATION -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Основные</a></li>
                                <li><a href="#tab2" role="tab" data-toggle="tab">Условия</a></li>
                                <li><a href="#tab3" role="tab" data-toggle="tab">Дополнительные поля</a></li>
                            </ul>
                            <!-- TAB CONTENT -->
                            <div class="tab-content">
                                <div class="active tab-pane fade in" id="tab1">
                                    <div class="form-group">
                                        <label for="namesite">Название сайта</label>
                                        <input type="text" class="form-control" name="namesite" id="namesite"
                                               placeholder="Введите название сайта">
                                    </div>
                                    <div class="form-group">
                                        <img src="" alt="">
                                        <label for="namesite">Иконка сайта</label>
                                        <input type="file" class="form-control" name="iconsite" id="iconsite">
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="form-group">

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    Пока в разработке
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
