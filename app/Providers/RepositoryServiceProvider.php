<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\FindGameRepository;
use App\Contracts\Game\FindGameInterface;
use App\Repositories\EloquentGameRepository;
use App\Contracts\Game\GameRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            GameRepositoryInterface::class,
            EloquentGameRepository::class
        );
        $this->app->bind(
            FindGameInterface::class,
            FindGameRepository::class
        );
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
