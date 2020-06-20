<?php

namespace App\Providers;

use App\Http\Repositories\JobRepository;
use App\Http\Repositories\JobRepositoryInterface;
use App\Http\Service\Job\JobServise;
use App\Http\Service\Job\JobServiseInterface;
use App\Http\Service\Role\RoleService;
use App\Http\Service\Role\RoleServiceInterface;
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
