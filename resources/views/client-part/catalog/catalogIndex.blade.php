@extends('layouts.client-part-layout')

@section('content')
    <div class="container">
        <div class="row">

            @foreach($goods as $good)
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">

                    <a href="/catalog/{{$good->slug}}">
                        <img src="/img/product/{{$good->article}}/{{$good->image_anons}}"
                             class="img-responsive center-block" alt="">
                    </a>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a href="/catalog/{{$good->slug}}">{{$good->title}}</a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {{$good->article}}
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {{$good->price}} ₽
                    </div>
                    <form action="/cart/addCart/{{$good->id}}" method="post">
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <input type="hidden" name="user_info" value="{{$user}}">
                        @endif
                        <input type="hidden" name="product_info" value="{{$good->id}}">
                        <input type="hidden" name="price" value="{{$good->price}}">
                        <button type="submit" class="btn btn-success">Добавить в корзину</button>
                        {{csrf_field()}}
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
