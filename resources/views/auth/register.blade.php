@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-offset-3 col-md-6">
                <form class="form-horizontal" action="{{ route('register') }}" method="POST">
                    @csrf
                    <span class="heading">РЕГИСТРАЦИЯ</span>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Введите логин">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Введите E-mail">
                        <i class="fa fa-envelope-o"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Введите пароль">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="form-group help">
                        <input type="password" name="password_confirmation" class="form-control" id="inputPassword" placeholder="Введите пароль повторно">
                        <i class="fa fa-lock"></i>
                    </div>
                    <div class="form-group">

                        <button type="submit" class="btn btn-default">ЗАРЕГЕСТРИРОВАТЬСЯ</button>
                    </div>
                </form>
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
@endsection
