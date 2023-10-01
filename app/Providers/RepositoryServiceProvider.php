<?php

namespace App\Providers;

use App\Repositories\MemberRepository;
use App\Repositories\ContactRepository;
use App\Repositories\AddressRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\ContactRepositoryInterface;
use App\Repositories\Interfaces\AddressRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
