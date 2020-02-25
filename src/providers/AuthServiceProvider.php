<?php

namespace Fc9\Auth\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Fc9\Auth\http\Middlewares\Authenticate;
use Fc9\Auth\Authentication;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerMiddleware();
        $this->registerBladeDirectives();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {

        $this->app->register(RouteServiceProvider::class);

        // Register the main class to use with the facade
        $this->app->singleton('authentication', function () {
            return new Authentication();
        });
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/packages/auth');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'auth');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'auth');
        }
    }

    /**
     * Register Config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([__DIR__ . '/../config/config.php' => config_path('auth.php'),], 'Config');

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'auth');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/packages/auth');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(
            array_merge(
                array_map(
                    function ($path) {
                        return $path . '/vendor/fc9/auth';
                    },
                    config()->get('view.paths')),
                [$sourcePath]
            ),
            'auth');
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (!app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(__DIR__ . '/../database/factories');
        }
    }

    /**
     * Register additional directives of Blade.
     *
     * @return void
     */
    public function registerBladeDirectives()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    public function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('auth', Authenticate::class);
    }
}
