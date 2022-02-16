<?php

namespace App\Providers;

use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\DepartmentRepositoryInterface;
use App\Contracts\DocumentRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\DocumentRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(DocumentRepositoryInterface::class,DocumentRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class,DepartmentRepository::class);
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
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
