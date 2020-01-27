@extends('layouts.main')

@section('content')
    <div id="app" class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Результаты поиска по запросу: "{{ $text }}"
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Поиск</li>
            </ol>
        </section>
        <search-admin text="{{ $text }}" route="{{ route('search_admin') }}"/>
    </div>
@endsection
