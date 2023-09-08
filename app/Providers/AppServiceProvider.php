<?php

namespace App\Providers;

use App\Repositories\MemberRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
