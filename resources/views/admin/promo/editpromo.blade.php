@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Редактирование промокода: {{$promo->discount_name}}
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
                        <form action="/admin/sale/edit/{{$promo->id}}" method="post" role="form">
                            <!-- TAB NAVIGATION -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Основные</a></li>
                                <li><a href="#tab2" role="tab" data-toggle="tab">Условия</a></li>
                                <li><a href="#tab3" role="tab" data-toggle="tab">Дополнительные поля</a></li>
                                <li><a href="#tab4" role="tab" data-toggle="tab">Доступность</a></li>
                            </ul>
                            <!-- TAB CONTENT -->
                            <div class="tab-content">
                                <div class="active tab-pane fade in" id="tab1">
                                    <div class="form-group">
                                        <label for="namepromo">Название промокода</label>
                                        <input type="text" class="form-control" name="namepromo" id="namepromo"
                                               placeholder="Введите название промокода"
                                               value="{{$promo->discount_name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="codepromo">Код</label>
                                        <input type="text" class="form-control" name="codepromo" id="codepromo"
                                               placeholder="Код" value="{{$promo->coupon}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="promocodedate">Продолжительность</label>

                                        <input type="datetime-local" class="form-control" name="promocodedate"
                                               id="promocodedate" value="{{$promo->date_apply}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="sizepromo">Размер скидки</label>
                                        <input type="text" class="form-control" name="sizepromo" id="sizepromo"
                                               placeholder="Введите размер скидки" value="{{$promo->size_promo}}">
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="tab2">
                                    <div class="form-group">
                                        <label for="goodspromo">Список товаров</label>
                                        <select name="goodspromo[]" id="goodspromo" class="form-control" multiple>
                                            @foreach($goods as $itemGood)
                                                <option value="{{$itemGood->id}}"
                                                        @if($promo->goods_items === $itemGood->id) selected @endif>
                                                    {{$itemGood->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3">
                                    Пока в разработке
                                </div>
                                <div class="tab-pane fade" id="tab4">
                                    <div class="form-group">
                                        <label for="statusgoods">Статус товара</label>
                                        <select name="statusgoods" id="statusgoods" class="form-control">
                                            <option value="published"
                                                    @if($promo->status == 'published') selected @endif>Опубликован
                                            </option>
                                            <option value="testgoods"
                                                    @if($promo->status == 'testgoods') selected @endif>Черновик
                                            </option>
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
