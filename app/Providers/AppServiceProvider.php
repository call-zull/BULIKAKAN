<?php

namespace App\Providers;

use App\Models\Pengumuman;
use App\Models\RequestOfficial;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\PengumumanObserver;
use App\Observers\RequestOfficialObserver;
use App\Observers\UserObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        RequestOfficial::observe(RequestOfficialObserver::class);
        Pengumuman::observe(PengumumanObserver::class);
    }
}
