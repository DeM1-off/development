<?php

namespace App\Providers;

use App\Repositories\JobRepository;
use App\Repositories\JobRepositoryInterface;
use App\Service\Job\JobServise;
use App\Service\Job\JobServiseInterface;
use App\Service\Role\RoleService;
use App\Service\Role\RoleServiceInterface;
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
        $this->app->bind(RoleServiceInterface::class,RoleService::class);
        $this->app->bind(JobServiseInterface::class,JobServise::class);
        $this->app->bind(JobRepositoryInterface::class,JobRepository::class);
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
