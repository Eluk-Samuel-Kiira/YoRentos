<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Rental;
use Illuminate\Support\Facades\View; 

class TenantMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $rental = Rental::where('status', 1)->get();
        View::share('rental', $rental);
    }
}
