@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-cube"></i> Заказ № {{$id}}
                        <small class="pull-right">{{$order->created_at}}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <strong>Заказчик</strong>
                    <address>
                        <b>ФИО:</b> {{$order->surname}} {{$order->name}} {{$order->last_name}}<br>
                        <b>Адрес:</b> ул. {{$order->street}} {{$order->house}} кв. {{$order->kvoroffice}}<br>
                        <b>Телефон:</b> {{$order->phone}}<br>
                        <b>Email:</b> {{$user_info->email}}
                    </address>
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <strong>Информация о заказе</strong>
                    <br>
                    <b>Оплачен:</b>

                    @if($order->payed == "Y")
                        Оплачен
                        @elseif($order->payed == "N")
                    Не оплачен
                    @endif<br>
                    <b>Дата оплаты:</b> {{$order->date_payed}}<br>
                    <b>Способ оплаты:</b> {{$order->pay_name}}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID продукта</th>
                            <th>Продукт</th>
                            <th>Кол-во</th>
                            <th>Цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td></td>
                            <td>{{$item->price}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-xs-12 col-lg-6">
                    <p class="lead">тут вроде дата доставки</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Способ доставки:</th>
                                <td>{{$order->delivery_name}}</td>
                            </tr>
                            <tr>
                                <th>Стоимость доставки</th>
                                <td>{{$order->price_delivery}}</td>
                            </tr>
                            <tr>
                                <th>Итого:</th>
                                <td>{{$order->price}}</td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <a href="#" target="_blank" class="btn btn-default" onclick="print();"><i class="fa fa-print"></i> Распечатать</a>
                    <a href="/admin/orders/{{$id}}/print" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;">
                        <i class="fa fa-download"></i> Создать PDF
                    </a>
                </div>
            </div>
        </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
    </div>


@endsection
