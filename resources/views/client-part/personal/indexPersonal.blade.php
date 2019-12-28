@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h1">
                Личный кабинет
            </div>
            <form action="/personal/edit" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="avatar" class="col-sm-1 control-label">Аватар</label>
                    <div class="col-sm-11">
                        <img src="/img/users/{{$user->avatar}}" alt="" class="personal-avatar">
                        <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Avatar" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="fio" class="col-sm-1 control-label">ФИО</label>
                    <div class="col-sm-11">
                        <input type="text" class="form-control" id="fio" name="fio" placeholder="Введите ФИО" value="{{$user->fio}}">
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-1 control-label">Телефон</label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Введите телефон" value="{{$user->phone}}">
                        </div>
                    </div>
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </div>


                </div>

            </form>
        </div>
    </div>

@endsection
