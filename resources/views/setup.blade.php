@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>Установка проекта</h3></div>
                    <div class="card-body">
                        <form action="/setup/success" method="post">
                            <div class="form-group">
                                <label for="">ФИО администратора</label>
                                <input type="text"
                                       class="form-control" name="fio" id="" aria-describedby="helpId" placeholder="Введите фио администратора">
                            </div>
                            <div class="form-group">
                                <label for="">Почта администратора</label>
                                <input type="email" class="form-control" name="email" id=""
                                       aria-describedby="emailHelpId"
                                       placeholder="Введите почтовый адрес администратора">
                            </div>
                            <div class="form-group">
                                <label for="">Пароль администратора</label>
                                <input type="password" class="form-control" name="password" id="" placeholder="Введите пароль адинистратора">
                            </div>
                            <div class="form-group">
                                <label for="">Иконка сайта</label>
                                <input type="file" class="form-control-file" name="favicon" id="" placeholder=""
                                       aria-describedby="fileHelpId">
                            </div>
                            <div class="form-group">
                                <label for="">Название сайта</label>
                                <input type="text"
                                       class="form-control" name="namesite" id="" aria-describedby="helpId" placeholder="Введите название сайта">
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success">Установить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
