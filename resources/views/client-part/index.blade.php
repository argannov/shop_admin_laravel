@extends('layouts.client-part-layout')
<meta name="description" content="{{$pages['meta_description']}}">
<meta name="keywords" content="{{$pages['meta_keywords']}}">
<title>{{$pages['title']}}</title>
@section('content')
    <div class="container-fluid">

        @if($pages['banners'][0]['image'] != null)

                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($pages['banners'] as $key=>$banner)
                            <div class="item <?php if ($key == 0) {
                                echo "active";
                            } ?>">
                                <img src="/admin/dist/img/{{$banner['image']}}" alt="">
                            </div>
                        @endforeach
                    </div>
                    <!-- Элементы управления -->
                    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Предыдущий</span>
                    </a>
                    <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Следующий</span>
                    </a>
                </div>

        @endif
    </div>
@endsection
