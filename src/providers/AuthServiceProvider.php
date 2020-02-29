<?php

namespace Fc9\Auth\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

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
        $this->loadSeeds();
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton('authentication', function () {
            return new \Fc9\Auth\Authentication();
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
        $this->publishes([__DIR__ . '/../config/auth.php' => config_path('auth.php'),], 'Config');
        config(['auth.providers.users.model' => 'Fc9\\Auth\\Entities\\User::class']);
        config(['auth.passwords.users.table' => 'password_reset']);

        $this->mergeConfigFrom(__DIR__ . '/../config/auth.php', 'auth');
        $this->mergeConfigFrom(__DIR__ . '/../config/parameters.php', 'auth::parameters');
        $this->mergeConfigFrom(__DIR__ . '/../config/validation.php', 'auth::validation');
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

    public function registerMiddleware()
    {
        $router = $this->app['router'];
        $router->aliasMiddleware('auth', \Fc9\Auth\Http\Middlewares\Authenticate::class);
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

    public function loadSeeds()
    {
        if ($this->app->runningInConsole()) {
            $command = Request::server('argv', null);
            if (is_array($command)) {
                $command = implode(' ', $command);
                if ($command == "artisan db:seed") {
                    Artisan::call('db:seed', ['--class' => \Fc9\Auth\Database\Seeders\DatabaseSeeder::class]);
                }
            }
        }
    }
}
