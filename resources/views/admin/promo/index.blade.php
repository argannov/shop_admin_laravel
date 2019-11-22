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
                                    <th>Код</th>
                                    <th>Размер скидки</th>
                                    <th>Дата окончания скидки</th>
                                    <th>Статус</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><a href="#">Новогодняя скидка</a></td>
                                    <td>CDFF-GDGF-4GF2-DGGT-HHH4</td>
                                    <td>30%</td>
                                    <td>31.12.2019</td>
                                    <td><span class="label label-success">Активен</span></td>
                                </tr>
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
