<?php

namespace App\Providers;

// use Illuminate\Support\Facades\App;

use App\Asteroide\Support\Monitor;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Route::resourceVerbs([
        // 	'create' => 'crear',
        // 	'edit' => 'editar',
        // ]);

        Paginator::defaultView('components.admin.pagination');
        Sanctum::ignoreMigrations();

        $this->app->bind('monitor', function ($app) {
            return new Monitor;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // App::setLocale('en');
        // Schema::defaultStringLength(191);

        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        Blade::directive('text', function ($text) {
            return "<?php echo nl2br($text); ?>";
        });

        if (! app()->runningInConsole()) {
            //
        }
    }
}
