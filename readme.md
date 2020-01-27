## Панель администратора для интернет-магазина на Laravel

<p>В будущем собственно и сам интерент-магазин</p>
PS: Весь проект собирается локально

## Установка проекта

<ol>
<li>Делаем клон проекта</li>
<li>Запускаем команды: composer install и npm install</li>
<li>Создаем базу данных</li>
<li>Прописываем в .env все доступы к базе</li>
<li>Также в файле database.php в папке /config</li>
</ol>

```sh 
$ php artisan migrate
```
<p>После успешной миграции можно запустить проект</p>

```sh 
$ php artisan serve
```

##Настройка поиска

В системе предусмотрен поиск по 4-м сущностям:
<ol>
    <li>Товары - Goods</li>
    <li>Заказы - Orders</li>
    <li>Статьи - Posts</li>
    <li>Магазины - Stores</li>
</ol>

###Windows

Установить и запустить ElasticSearch по <a href="https://www.elastic.co/downloads/elasticsearch">этой инструкции</a>

###После установки ElasticSearch

Создать индексы для каждой сущности запустив команды:

```sh 
$ php artisan elastic:create-index "App\Search\Configurators\GoodsIndexConfigurator"
$ php artisan elastic:create-index "App\Search\Configurators\OrdersIndexConfigurator"
$ php artisan elastic:create-index "App\Search\Configurators\PostsIndexConfigurator"
$ php artisan elastic:create-index "App\Search\Configurators\StoresIndexConfigurator"
```

Далее необходимо испортировать записи в базе в наши поисковые индексы запустив команды:

```sh 
$ php artisan elastic:create-index "App\Goods"
$ php artisan elastic:create-index "App\Orders"
$ php artisan elastic:create-index "App\Posts"
$ php artisan elastic:create-index "App\Stores"
```

## Документация по проекту

### Структура проекта

<p>Основные контроллеры админки находятся в директории /app/Http/Contollers/Admin</p>
<p>Основные контроллеры клиент-части находятся в директории /app/Http/Contollers/</p>
<p>Классы риквесты с валидацией - /app/Http/Requests/</p>
<p>Конфиги поисковых индексов - /app/Search/Configurators</p>
<p>Правила поиска для моделей - /app/Search/Rules</p>
<p>Все сервисы в директории /app/Services</p>
<p>Все модели проекта в /app</p>
<p>Vue компоненты пользовательского интерфейса находятся в директории /resources/js/components</p>
<p>Для автоматической компиляции компонентов запустите к</p>
<p>Файлы могут быть логически сгруппированы</p>
<p>Публичные картинки, загружаемые пользователями находятся в /public/img/</p>
<p>Роутинг в /routes/web.php</p>
<p>Стили и скрипты сайта находятся в /public/css и /public/js</p>
<p>Все стили и скрипты для админки находятся в /public/admin/</p>

### Права пользователей

<p>На данный момент есть 3 уровня доступа:</p>
<ol>
<li>Администраторы</li>
<li>Зарегестрированный пользователь</li>
<li>Гость</li>
</ol>

<p>Добавить в группу администоров можно через БД, позже в админке в разделе пользователи - Права доступа или по адресу /admin/roles/ </p>
<p>Логика работы прав доступа расписана в контроллере Permission и прописана в роутинге</p>
<p>В роутинге распределение идет по middleware, а именно: </p>

```sh 
['middleware' => 'auth'] //Авторизированный пользователь
```

```sh 
['middleware' => 'admin:admin'] // Только администратор
```

<p>Планы на будущее - добавить 2 группы пользователей и настройка этих прав из админки</p>
<p>Модераторов и Контент-менеджеров. У этих группы будет ограниченный доступ в панель администрирования</p>

### Актуальные правки и комментарии по задачам

<p>Все правки по проекту ведутся в разделе Project этого репозитория. Есть соответствующие колонки для работы. Если возникли вопросы по задаче - открываем Issues по задаче и пишем вопросы.</p>

## Комментарий разработчика

<p>Все доступы тестовые(локальные)</p>
<p>В сборку также добавляю sql файл, для упрощения работы с бд. Т.е. создавать и наполнять базу не надо, возможно и проведение миграций будет также не актуально, но это для самых ленивых :)</p>
