@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h1">
                Статьи
            </div>
            @foreach($posts as $post)
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <img src="/img/posts/{{$post->image}}" class="img-responsive center-block">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <a href="/news/{{$post->slug}}">{{$post->title}}</a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        {{$post->anons}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
