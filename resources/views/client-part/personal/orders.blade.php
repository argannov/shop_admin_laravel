@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success order-success">
                    {{ session('status') }}
                </div>
            @endif

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h1">
                    Заказы
                </div>
            @if(!empty($order))
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @foreach($order as $itemOrder)
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion"
                                       href="#collapse{{$itemOrder->id}}"
                                       aria-expanded="true" aria-controls="collapseOne">
                                        Заказ №{{$itemOrder->id}}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{$itemOrder->id}}" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingOne">
                                {{$itemOrder->price}}
                            </div>
                        </div>
                    </div>
                @endforeach
                    </div>
                @else

                Заказов нет

            @endif
        </div>
    </div>
@endsection
