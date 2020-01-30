@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Промокоды
            </h1>
            <div class="input-group-btn">
                <a href="/admin/sale/create" class="btn btn-success">Добавить промокод</a>
            </div>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Все заказы</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="app">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <table-with-filter
                        v-bind:settings="{{ $settings }}"
                        route="{{ route('fetch_promocods') }}"
                        edit-route="{{ route('edit_promocode') }}"
                        delete-route="{{ route('delete_promocode') }}"
                        csrf-token="{{ csrf_token() }}"
                    />
                </div>
            </div>
        </section>
    </div>

@endsection
