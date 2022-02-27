<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\HouseRepository::class, \App\Repositories\HouseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProvinceRepository::class, \App\Repositories\ProvinceRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\DistrictRepository::class, \App\Repositories\DistrictRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CommuneRepository::class, \App\Repositories\CommuneRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HouseCategoryRepository::class, \App\Repositories\HouseCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HouseTypeRepository::class, \App\Repositories\HouseTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HouseUtilityRepository::class, \App\Repositories\HouseUtilityRepositoryEloquent::class);
        //:end-bindings:
    }
}
