@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Все статьи
            </h1>

            <div class="input-group-btn">
                <a href="/admin/posts/create" class="btn btn-success">Добавить статью</a>
            </div>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Все статьи</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Всего: {{$count}}</h3>

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
                                    <th>Дата Изм.</th>
                                    <th>Активность</th>
                                    <th>Описание</th>

                                </tr>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td><a href="/admin/posts/{{$post->slug}}">{{$post->title}}</a></td>
                                    <td>{{$post->created_at}}</td>
                                    <td>@if($post->status == 'published')<span class="label label-success">АКТИВЕН</span>@else <span class="label label-warning">ЧЕРНОВИК</span>@endif</td>
                                    <td>{{$post->anons}}</td>
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
