@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h1">
                {{$post->title}}
            </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <img src="/img/posts/{{$post->image}}" class="img-responsive">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        {!!$post->body!!}
                    </div>

                </div>

        </div>
    </div>

@endsection
