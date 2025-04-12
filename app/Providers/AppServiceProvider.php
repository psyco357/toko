<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\UserModel;

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
        // Mengirim data user ke semua view yang membutuhkan
        View::composer(['komponen.sidebar', 'komponen.header', 'konten.*'], function ($view) {
            $user = session('user');
            $view->with('user', $user);
        });
    }
}
