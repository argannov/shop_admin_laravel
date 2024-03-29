@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Все заказы
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Все заказы</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Всего:
                               {{$count}}
                            </h3>

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
                                    <th>ФИО клиента</th>
                                    <th>Адрес доставки</th>
                                    <th>Дата создания</th>
                                    <th>Сумма заказа</th>
                                    <th>Статус</th>

                                </tr>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><a href="/admin/orders/{{$order->id}}">{{$order->id}}</a></td>
                                        <td>{{$order->surname}} {{$order->name}} {{$order->last_name}}</td>
                                        <td>{{$order->street}},{{$order->house}} кв/оф №{{$order->kvoroffice}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td>{{$order->price+$order->price_delivery}} ₽</td>
                                        <td><span class="label label-warning">Обработка</span></td>
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
