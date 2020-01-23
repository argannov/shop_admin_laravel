<?php

namespace App\Providers;

use App\Http\Controllers\Admin\NewGoodsController;
use App\Http\Controllers\Admin\NewStoreController;
use App\Services\FiltrationKeeper\FiltrationKeeperService;
use App\Services\FiltrationKeeper\Interfaces\FiltrationKeeper;
use App\Services\Repository\GoodsRepository;
use App\Services\Repository\Interfaces\Repository;
use App\Services\Repository\StoresRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(NewStoreController::class)
            ->needs(Repository::class)
            ->give(function () {
                return new StoresRepository();
            });

        $this->app->when(NewGoodsController::class)
            ->needs(Repository::class)
            ->give(function () {
                return new GoodsRepository($this->app->make(FiltrationKeeper::class));
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
