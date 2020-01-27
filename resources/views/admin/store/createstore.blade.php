@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                @if (!empty($store)) Обновление @else Создание @endif магазина
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
                        @if ($errors->any())
                            <div class="alert alert-danger  fade in">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <strong>
                                                {{ $error }}
                                            </strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (isset($store))
                            <form action="{{ route('update_store', ['id' => $store->id]) }}" method="POST" enctype="multipart/form-data">
                        @else
                            <form action="{{ route('create_store') }}" method="POST" enctype="multipart/form-data">
                        @endif
                            @csrf
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
                                        <label for="name">Наименование магазина</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               placeholder="Введите название товара"
                                               @if (!empty($store) && isset($store->name)) value="{{ $store->name }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Символьный код</label>
                                        <input type="text" class="form-control" name="slug" id="slug"
                                               placeholder="Введите символьный код товара"
                                               @if (!empty($store) && isset($store->slug)) value="{{ $store->slug }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label class="custom-file">
                                            Изображение магазина
                                            <input type="file" id="file" name="image" class="custom-file-input">
                                            <span class="custom-file-control"></span>
                                        </label>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="form-group">
                                        <label for="address">Адрес магазина</label>
                                        <input type="text" class="form-control" name="address" id="address"
                                               placeholder="Введите символьный код товара"
                                               @if (!empty($store) && isset($store->address)) value="{{ $store->address }}" @endif>
                                    </div>
                                    <div class="form-group">
                                        <label for="geolocation">Коориднаты для карты</label>
                                        <input type="text" class="form-control" name="geolocation" id="geolocation"
                                               placeholder="Введите символьный код товара"
                                               @if (!empty($store) && isset($store->geolocation)) value="{{ $store->geolocation }}" @endif>
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
