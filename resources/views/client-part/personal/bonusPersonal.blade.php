@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h1">
                Бонусная система
            </div>

            @if($bonuses)
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Номер карты: {{$bonuses->card_number}}
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Количество баллов: {{$bonuses->val_bonus}}
                </div>
            @else
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    У вас нет карты
                </div>
            @endif
        </div>
    </div>

@endsection
