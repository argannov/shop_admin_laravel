<?php

namespace App\Providers;

use App\Http\Controllers\Admin\NewGoodsController;
use App\Http\Controllers\Admin\NewPromocodeController;
use App\Http\Controllers\Admin\NewStoreController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\TechSupport\QuestionsController;
use App\Services\FiltrationKeeper\FiltrationKeeperService;
use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\GoodsRepository;
use App\Services\Repository\Interfaces\Repository;
use App\Services\Repository\OrdersRepository;
use App\Services\Repository\PromocodsRepository;
use App\Services\Repository\QuestionsRepository;
use App\Services\Repository\StoresRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    const REPOSITORY_MAP = [
        NewStoreController::class => StoresRepository::class,
        NewGoodsController::class => GoodsRepository::class,
        QuestionsController::class => QuestionsRepository::class,
        OrdersController::class => OrdersRepository::class,
        NewPromocodeController::class => PromocodsRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (self::REPOSITORY_MAP as $controller => $repository)
        $this->app->when($controller)
            ->needs(Repository::class)
            ->give(function () use ($repository) {
                return new $repository($this->app->make(FiltrationKeeper::class));
            });

        $this->app->bind(FiltrationKeeper::class, function () {
            return new FiltrationKeeperService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
