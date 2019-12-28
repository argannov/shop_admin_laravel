@extends('layouts.main')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="all-goods-h1">
                Все бонусные карты
            </h1>

            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-tv"></i>На сайт</a></li>
                <li><a href="/admin/dashboard">Дашборд</a></li>
                <li class="active">Все бонусные карты</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Всего: {{count(\App\Bonus::all())}}

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
                                    <th>Номер карты</th>
                                    <th>Количество баллов</th>
                                    <th>Дата создания</th>
                                    <th>Статус</th>

                                </tr>
                                @foreach($bonuses as $bonus)
                                    <tr>
                                        <td>{{$bonus->id}}</td>
                                        <td><a href="/admin/users/{{$bonus->id_users}}">{{\App\User::where('id',$bonus->id_users)->first()->fio}}</a></td>
                                        <td>{{$bonus->card_number}}</td>
                                        <td>{{$bonus->val_bonus}}</td>
                                        <td>{{$bonus->created_at}}</td>
                                        <td>@if($bonus->status == 'Y') Активен @else Не активен @endif</td>
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
