<?php

namespace Fc9\Auth\Providers;

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Passport;
use Fc9\Auth\Entities\Client;
use Fc9\Auth\Entities\AuthCode;
use Fc9\Auth\Entities\PersonalAccessClient;
use Fc9\Auth\Entities\AccessToken;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
//    protected $policies = [
//        'Auth\Policy' => 'Fc9\Auth\Policies\ModelPolicy',
//    ];

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerPolicies(); #extends

        $this->configPassportTokens();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerMiddleware();
        $this->registerBladeDirectives();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadSeeds();
        $this->configApi();
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

    protected function configPassportTokens()
    {
        Passport::routes(/*function ($router) {
            $router->forAccessTokens();
            $router->forPersonalAccessTokens();
            $router->forTransientTokens();*/
        );

        // Configuration Token Lifetimes
        Passport::tokensExpireIn(now()->addMinutes(10));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        // Overriding Default Models
        Passport::useTokenModel(AccessToken::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/vendor/auth');

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

        config(['auth.guards.web.driver' => 'session']);
        config(['auth.guards.web.provider' => 'users']);
        config(['auth.guards.api.driver' => 'passport']);
        config(['auth.guards.api.provider' => 'users']);

        config(['auth.providers.users.model' => \Fc9\Auth\Entities\User::class]);
        config(['auth.passwords.users.provider' => 'users']);
        config(['auth.passwords.users.table' => 'password_reset']);

        config(['database.connections.mysql.engine' => 'InnoDB']);

        $this->mergeConfigFrom(__DIR__ . '/../config/auth.php', 'auth');
        $this->mergeConfigFrom(__DIR__ . '/../config/parameters.php', 'auth::parameters');
        $this->mergeConfigFrom(__DIR__ . '/../config/policy.php', 'auth::policy');
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

    public function configApi()
    {
        \Fc9\Api\Http\Response::addFormatter('json', new  \Fc9\Api\Http\Response\Format\Jsonp);

        app('Fc9\Api\Http\RateLimit\Handler')->extend('authenticated', function ($app) {
            return new \Fc9\Api\Http\RateLimit\Throttle\Authenticated;
        });

        app('Fc9\Api\Transformer\Factory')->setAdapter(function ($app) {
            $fractal = new \League\Fractal\Manager;
            $fractal->setSerializer(new \League\Fractal\Serializer\JsonApiSerializer);
            return new \Fc9\Api\Transformer\Adapter\Fractal($fractal);
        });

        app('Fc9\Api\Exception\Handler')->setErrorFormat([
            'error' => [
                'message' => ':message',
                'errors' => ':errors',
                'code' => ':code',
                'status_code' => ':status_code',
                'debug' => ':debug'
            ]
        ]);
    }
}
