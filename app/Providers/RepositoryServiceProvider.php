<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {


    $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    $this->app->bind(\App\Interfaces\ExampleRepositoryInterface::class, \App\Repositories\ExampleRepository::class);
    $this->app->bind(\App\Interfaces\StudentRepositoryInterface::class, \App\Repositories\StudentRepository::class);
    $this->app->bind(\App\Interfaces\RolesRepositoryInterface::class, \App\Repositories\RolesRepository::class);
    }






    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
