<?php

namespace App\Providers;

use App\Models\User\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

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
        Model::preventLazyLoading(!$this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes($this->app->isLocal());

        Vite::macro('img', fn (string $asset) => $this->asset("resources/images/{$asset}"));

        Gate::define('admin', function (User $user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::denyAsNotFound();
        });

        Paginator::useBootstrapFive();

        Blade::componentNamespace('MadBob\\Larastrap\\Components', 'ls');
    }
}
