<?php

namespace App\Providers;

use App\Contracts\DocumentRepositoryInterface;
use App\Repositories\DocumentRepository;
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
