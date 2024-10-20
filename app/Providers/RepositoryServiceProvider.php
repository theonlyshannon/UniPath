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
    public function register()
    {

    $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    $this->app->bind(\App\Interfaces\MentorRepositoryInterface::class, \App\Repositories\MentorRepository::class);
    $this->app->bind(\App\Interfaces\StudentRepositoryInterface::class, \App\Repositories\StudentRepository::class);
    $this->app->bind(\App\Interfaces\WriterRepositoryInterface::class, \App\Repositories\WriterRepository::class);
    $this->app->bind(\App\Interfaces\RoleRepositoryInterface::class, \App\Repositories\RoleRepository::class);
    $this->app->bind(\App\Interfaces\PermissionRepositoryInterface::class, \App\Repositories\PermissionRepository::class);
    $this->app->bind(\App\Interfaces\ArticleCategoryRepositoryInterface::class, \App\Repositories\ArticleCategoryRepository::class);
    $this->app->bind(\App\Interfaces\ArticleTagRepositoryInterface::class, \App\Repositories\ArticleTagRepository::class);
    $this->app->bind(\App\Interfaces\ArticleRepositoryInterface::class, \App\Repositories\ArticleRepository::class);
    $this->app->bind(\App\Interfaces\UniversityRepositoryInterface::class, \App\Repositories\UniversityRepository::class);
    $this->app->bind(\App\Interfaces\FacultyRepositoryInterface::class, \App\Repositories\FacultyRepository::class);

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
