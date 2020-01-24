@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Все сообщения
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Все сообщения</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content" id="app">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <table-with-filter
                        v-bind:settings="{{ $settings }}"
                        route="{{ route('fetch_questions') }}"
                        edit-route="{{ route('edit_question') }}"
                        delete-route="{{ route('delete_question') }}"
                        csrf-token="{{ csrf_token() }}"
                    />
                </div>
            </div>
        </section>
    </div>

@endsection
