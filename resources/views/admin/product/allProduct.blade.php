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
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Всего: 1337</h3>

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
                                    <th>Цена</th>
                                    <th>Удалить</th>

                                </tr>
                                @foreach($goods as $good)
                                    <tr>
                                        <td>{{$good['id']}}</td>
                                        <td><a href="/admin/product/edit/{{$good['id']}}">{{$good['title']}}</a></td>
                                        <td>{{$good['updated_at']}}</td>
                                        <td><span class="label @if($good['status'] == 'published')
                                                label-success
                                                  @elseif($good['status'] == 'testgoods')
                                                label-warning
                                                @endif
                                                ">
                                                @if($good['status'] == 'published')Активен
                                                @elseif($good['status'] == 'testgoods')Черновик
                                                @endif</span></td>
                                        <td>{{$good['price']}} ₽</td>
                                        <td>
                                            <form action="/admin/product/delete/{{$good['id']}}" method="post">
                                                <button type="submit" class="btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                                {{csrf_field()}}
                                            </form>
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
