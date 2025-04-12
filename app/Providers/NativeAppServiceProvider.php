<?php

namespace App\Providers;

use Native\Laravel\Facades\Menu;
use Native\Laravel\Facades\Window;
use Illuminate\Support\ServiceProvider;

class NativeAppServiceProvider extends ServiceProvider
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
        // // Buat window utama aplikasi
        // Window::open()
        //     ->title('TokoKita')
        //     ->width(1024)
        //     ->height(768);

        // // (Opsional) Buat menu aplikasi
        // Menu::add('File')
        //     ->addItem('Quit', 'cmd+q', fn() => Window::close());
    }
}
