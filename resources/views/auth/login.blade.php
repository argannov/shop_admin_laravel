@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal" action="{{route('login')}}" method="POST">
                    <span class="heading">АВТОРИЗАЦИЯ</span>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="E-mail">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                        <i class="fa fa-lock"></i>
                        <a href="#" class="fa fa-question-circle"></a>
                    </div>
                    <div class="form-group">
                        <div class="main-checkbox">
                            <input type="checkbox" value="none" id="checkbox1" name="check"/>
                            <label for="checkbox1"></label>
                        </div>
                        <span class="text">Запомнить</span>
                        @csrf
                        <button type="submit" class="btn btn-default">ВХОД</button>
                    </div>
                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
