<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Панель управления - {{config('app.name')}}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/bower_components/jvectormap/jquery-jvectormap.css') }}">

    <link rel="stylesheet"
          href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="shortcut icon" href="{{\Illuminate\Support\Facades\Storage::url('favicon.ico')}}" type="image/x-icon">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: 'textarea'});</script>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        var csrfToken = "{!! csrf_token() !!}";
    </script>

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <a href="/" class="logo">

            <span class="logo-lg">{{ config('app.name') }}</span>
        </a>

        <nav class="navbar navbar-static-top">

            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{count(\App\Alerts::where('user_id','=',Auth::id())->get())}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if(count(\App\Alerts::where('user_id','=',Auth::id())->get()) == 0)
                                <li class="header">У вас нет оповещений</li>
                            @else
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-red"></i> 5 new members joined
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-user text-red"></i> You changed your username
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/img/users/{{\App\User::where('id',Auth::id())->first()->avatar}}"
                                 class="user-image" alt="User Image">
                            <span class="hidden-xs">{{\App\User::where('id',Auth::id())->first()->fio}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="/img/users/{{\App\User::where('id',Auth::id())->first()->avatar}}"
                                     class="img-circle" alt="User Image">

                                <p>
                                    {{\App\User::where('id',Auth::id())->first()->fio}}
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-right">
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>


                </ul>
            </div>
        </nav>
    </header>

    <aside class="main-sidebar">

        <section class="sidebar">

            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/img/users/{{\App\User::where('id',Auth::id())->first()->avatar}}" class="img-circle"
                         alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{\App\User::where('id',Auth::id())->first()->fio}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <form action="{{ route('search_admin') }}" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="text" class="form-control" placeholder="Поиск ..."
                           @if (isset($text)) value="{{ $text }}" @endif>
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>


            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Основное меню</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cube"></i> <span>Товары</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/product"><i class="fa fa-circle-o"></i>Все товары</a></li>
                        <li><a href="/admin/product/create"><i class="fa fa-circle-o"></i>Создать новый товар</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/admin/orders">
                        <i class="fa fa-cubes"></i>
                        <span>Заказы</span>
                        <span class="pull-right-container">
              <span class="label label-primary pull-right">{{count($order = \App\Orders::all())}}</span>
            </span>
                    </a>
                </li>
                <li>
                    <a href="/admin/sale">
                        <i class="fa fa-rouble"></i> <span>Скидки на товары</span>
                        <span class="pull-right-container">
            </span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-o"></i>
                        <span>Страницы</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/pages/create"><i class="fa fa-circle-o"></i> Создать страницу</a></li>
                        <li><a href="/admin/pages"><i class="fa fa-circle-o"></i> Все страницы</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-heart"></i>
                        <span>Статьи</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/posts/create"><i class="fa fa-circle-o"></i>Создать статью</a></li>
                        <li><a href="/admin/posts/"><i class="fa fa-circle-o"></i>Все статьи</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Пользователи</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/users"><i class="fa fa-circle-o"></i>Все пользователи</a></li>
                        <li><a href="/admin/roles"><i class="fa fa-circle-o"></i>Права пользователей</a></li>
                    </ul>
                </li>
                {{--                <li class="treeview">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-map-o"></i> <span>Магазины</span>--}}
                {{--                        <span class="pull-right-container">--}}
                {{--              <i class="fa fa-angle-left pull-right"></i>--}}
                {{--            </span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="treeview-menu">--}}
                {{--                        <li><a href="/admin/store/"><i class="fa fa-circle-o"></i>Все магазины</a></li>--}}
                {{--                        <li><a href="/admin/store/create"><i class="fa fa-circle-o"></i>Добавить магазин</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                <li>
                    <a href="/admin/bonus">
                        <i class="fa fa-trophy"></i> <span>Бонусная система</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                {{--                <li class="treeview">--}}
                {{--                    <a href="#">--}}
                {{--                        <i class="fa fa-at"></i>--}}
                {{--                        <span>Техническая поддержка</span>--}}
                {{--                        <span class="pull-right-container">--}}
                {{--                            <i class="fa fa-angle-left pull-right"></i>--}}
                {{--                        </span>--}}
                {{--                    </a>--}}
                {{--                    <ul class="treeview-menu">--}}
                {{--                        <li><a href="{{ route('show_questions') }}"><i class="fa fa-circle-o"></i>Обращения</a></li>--}}
                {{--                        <li><a href="{{ route('create_question') }}"><i class="fa fa-circle-o"></i>Написать обращение</a></li>--}}
                {{--                    </ul>--}}
                {{--                </li>--}}
                <li>
                    <a href="/admin/setting">
                        <i class="fa fa-cogs"></i> <span>Настройки</span>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
            </ul>
        </section>

    </aside>
    @yield('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Версия 0.2.1
        </div>
        Copyright &copy; 2019-2020 FireAdmin E-commerce panel
    </footer>


    <div class="control-sidebar-bg"></div>
</div>


<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/morris.js/morris.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>

<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>

<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>
<script src="{{ asset('/js/app.js') }}"></script>
<script>
    $(".alert").alert()
</script>
</body>
</html>
