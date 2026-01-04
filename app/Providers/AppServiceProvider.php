<?php

namespace App\Providers;

use Filament\Auth\Http\Responses\LoginResponse as ResponsesLoginResponse;
use Filament\Auth\Http\Responses\LogoutResponse as ResponsesLogoutResponse;
use Illuminate\Support\ServiceProvider;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\LogoutResponse;
use App\Models\Pesanan;
use App\Observers\PesananObserver;
use App\Models\PesananSatuan;
use App\Models\PesananLayanan;
use App\Observers\PesananDetailObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The container singletons that should be registered.
     * 
     * @var array<class-string, class-string>
     */
    public $singletons = [
        ResponsesLoginResponse::class => LoginResponse::class,
        ResponsesLogoutResponse::class => LogoutResponse::class,
    ];
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
        // Pesanan::observe(PesananObserver::class);
        // PesananSatuan::observe(PesananDetailObserver::class);
        // PesananLayanan::observe(PesananDetailObserver::class);
    }
}
