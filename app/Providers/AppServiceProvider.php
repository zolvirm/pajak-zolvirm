<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // untuk format RP di blade dengan memanggil @rupiah($data->item) tanpa {{  }}
        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        //agar paginasi menggunakan css bootstrap
        Paginator::useBootstrapFive();
    }
}
