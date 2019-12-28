@extends('layouts.client-part-layout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h2">
                    Оформление заказа
                </div>
                <form action="/order/create" method="post" role="form" id="orderForm">
                    <legend>Личные данные</legend>
                    <div class="form-group">
                        <label for="fio_user">Фамилия</label>
                        <input type="text" class="form-control" name="fio_user" id="fio_user"
                               placeholder="Введите фамилию">
                    </div>
                    <div class="form-group">
                        <label for="name_user">Имя</label>
                        <input type="text" class="form-control" name="name_user" id="name_user"
                               placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="lastname_user">Отчество</label>
                        <input type="text" class="form-control" name="lastname_user" id="lastname_user"
                               placeholder="Введите имя">
                    </div>
                    <div class="form-group">
                        <label for="phone_user">Телефон</label>
                        <input type="text" class="form-control" name="phone_user" id="phone_user"
                               placeholder="Введите телефон">
                    </div>
                    <div class="form-group">
                        <label for="street_user">Адрес</label>
                        <input type="text" class="form-control" name="street" id="street_user"
                               placeholder="Введите полный адрес">
                        <label for="house_user">Дом</label>
                        <input type="text" class="form-control" name="house" id="house_user"
                               placeholder="Введите номер дома">
                        <label for="numberkv">Номер квартиры или офиса</label>
                        <input type="text" class="form-control" name="numberkv" id="numberkv"
                               placeholder="Введите номер квартиры или офиса">
                    </div>
                    <legend>Способ доставки</legend>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="delivery" class="checkboxDelivery" value="PochtaRussia">
                                    Почта России
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="delivery" class="checkboxDelivery" value="PochtaRussia2">
                                    Почта России2
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="delivery" class="checkboxDelivery" value="PochtaRussia3">
                                    Почта России3
                                </label>
                            </div>
                        </div>
                    </div>

                    <legend>Способ оплаты</legend>
                    <div class="form-group">
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="pay" class="checkboxPay" value="card-site">
                                    Банковской картой
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="pay" class="checkboxPay" value="nal-site">
                                    Наличными при доставке
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="pay" class="checkboxPay" value="card-curier">
                                    Банковской картой курьеру
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="price_order" value="{{$sum}}">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-primary">Оформить заказ</button>
                </form>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 h3">
                    Корзина
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Стоимость доставки: {{$delivery}}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    Итого: {{$sum}}
                </div>
            </div>
        </div>
    </div>

@endsection
