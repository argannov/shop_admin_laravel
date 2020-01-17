@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
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
        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-xs-12">
                    <h3 class="box-title">Всего записей найдено: {{ $total }}</h3>
                    @foreach ($results as $result)
                        @if (empty($result['list']))
                            @continue
                        @endif

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ $result['title'] }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach ($result['list'] as $key => $item)
                                        <tr>
                                            <td style="width: 10px">{{ $key + 1 }}</td>
                                            <td>
                                                @if (isset($item['link']))
                                                    <a href="{{ $item['link'] }}">
                                                        {!! $item['title'] !!}
                                                    </a>
                                                    <p>
                                                        {!! $item['highlight'] !!}
                                                    </p>
                                                @else
                                                    <p>
                                                        {!! $item['title'] !!}
                                                    </p>
                                                    <p>
                                                        {!! $item['highlight'] !!}
                                                    </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <li><a href="#">«</a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
