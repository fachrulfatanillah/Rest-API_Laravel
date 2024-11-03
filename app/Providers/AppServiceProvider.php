<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        $this->mapApiRoutesPost();
        $this->mapApiRoutesGet();
    }

    protected function mapApiRoutesPost()
    {
        Route::middleware('api')
            ->prefix('post')
            ->group(base_path('routes/api.php'));
    }
    protected function mapApiRoutesGet()
    {
        Route::middleware('api')
            ->prefix('get')
            ->group(base_path('routes/api.php'));
    }
}
