@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h1">
                Корзина
            </div>
            @if(isset($good))
                @foreach($good as $item)
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @foreach($item as $one)
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <img src="/img/product/{{$one->article}}/{{$one->image_anons}}" alt=""
                                     class="img-responsive center-block">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    {{$one->title}}
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                </div>
                            </div>

                        @endforeach
                    </div>
                @endforeach
            <form action="/order/" method="post">
                <input type="hidden" name="user_info" value="{{Auth::id()}}">
                {{csrf_field()}}
                <button type="submit" class="btn btn-success">Оформить заказ</button>
            </form>
                @else
                Корзина пуста
            @endif
        </div>
    </div>
@endsection
