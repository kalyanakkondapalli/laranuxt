<?php

namespace App\Providers;

use App\Repository\User\UserContract;
use Illuminate\Support\ServiceProvider;
use App\Repository\User\UserRepository;
use App\Repository\Company\CompanyContract;
use App\Repository\Company\CompanyRepository;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserContract::class, UserRepository::class);
        $this->app->bind(CompanyContract::class, CompanyRepository::class);
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
