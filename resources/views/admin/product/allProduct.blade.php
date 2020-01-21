@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Все товары
            </h1>

            <div class="input-group-btn">
                <a href="/admin/product/create" class="btn btn-success">Добавить товар</a>
            </div>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Все товары</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="app">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            {{--<h3 class="box-title">Всего: {{$count}}</h3>--}}

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
                        <data-table
                            v-bind:settings="{{ $settings }}"
                            route="{{ route('fetch_product') }}"
                            edit-route="{{ route('edit_product') }}"
                            delete-route="{{ route('delete_product') }}"
                            csrf-token="{{ csrf_token() }}"
                        />
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>

@endsection
