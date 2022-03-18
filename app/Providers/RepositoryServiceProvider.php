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
        $this->app->bind(\App\Repositories\ContractRepository::class, \App\Repositories\ContractRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HouseFeeRepository::class, \App\Repositories\HouseFeeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\FeeCategoryRepository::class, \App\Repositories\FeeCategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomAmenityRepository::class, \App\Repositories\RoomAmenityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HouseAmenityRepository::class, \App\Repositories\HouseAmenityRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomPictureRepository::class, \App\Repositories\RoomPictureRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HouseRuleRepository::class, \App\Repositories\HouseRuleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HousePictureRepository::class, \App\Repositories\HousePictureRepositoryEloquent::class);
        //:end-bindings:
    }
}
