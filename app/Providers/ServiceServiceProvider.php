<?php

namespace App\Providers;

use App\Services\MemberService;
use App\Services\ContactService;
use App\Services\AddressService;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\MemberServiceInterface;
use App\Services\Interfaces\ContactServiceInterface;
use App\Services\Interfaces\AddressServiceInterface;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MemberServiceInterface::class, MemberService::class);
        $this->app->bind(AddressServiceInterface::class, AddressService::class);
        $this->app->bind(ContactServiceInterface::class, ContactService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
