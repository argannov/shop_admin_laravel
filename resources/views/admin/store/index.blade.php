@extends('layouts.main')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="all-goods-h1">
            Все магазины
        </h1>

        <div class="input-group-btn">
            <a href="/admin/store/create" class="btn btn-success">Добавить магазин</a>
        </div>

        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
            <li><a href="/admin/dashboard">Дашборд</a></li>
            <li class="active">Все магазины</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Всего: {{ count($stores) }}</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                       placeholder="Поиск...">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i>
                                    </button>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>

                                <th>ID</th>
                                <th>Название</th>
                                <th>Адрес</th>
                                <th>Координаты</th>
                                <th>Активность</th>

                            </tr>
                            @foreach($stores as $store)
                                <tr>
                                    <td>{{ $store->id }}</td>
                                    <td><a href="{{ route('show_store', ['slug' => $store->slug]) }}">{{ $store->name }}</a></td>
                                    <td>{{ $store->address }}</td>
                                    <td>{{ $store->geolocation }}</td>
                                    <td><span class="label {{ $store->active ? 'label-success' : 'label-danger' }}">{{ $store->active ? 'АКТИВЕН' : 'НЕ АКТИВЕН' }}</span></td>
                                    <td>
                                        <button class="btn btn-danger delete-btn" data-route="{{ route('delete_store', ['slug' => $store->slug]) }}">Удалить</button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>

@endsection
