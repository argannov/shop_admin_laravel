<?php

namespace App\Providers;

use App\Http\Controllers\Admin\NewStoreController;
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
