@extends('layouts.client-part-layout')

@section('content')
    <div class="container">
        <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="/img/product/{{$good->article}}/{{$good->image_anons}}"
                                 class="img-responsive center-block" alt="">
                        </div>

                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{$good->title}}
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {{$good->price}}
                            </div>
                        </div>
                    </div>

        </div>
    </div>
@endsection
