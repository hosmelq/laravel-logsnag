<?php

declare(strict_types=1);

namespace HosmelQ\LogSnag\Laravel;

use HosmelQ\LogSnag\Laravel\Contracts\ClientContract;
use HosmelQ\LogSnag\Laravel\Exceptions\ApiTokenIsMissing;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class LogSnagServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/logsnag.php', 'logsnag'
        );

        $this->app->singleton(ClientContract::class, function ($app): Client {
            $config = $app['config']['logsnag'];

            if (! is_string($apiToken = $config['api_token'])) {
                throw ApiTokenIsMissing::create();
            }

            return LogSnag::factory()
                ->withApiToken($apiToken)
                ->withHttpClient(Http::throw())
                ->make();
        });

        $this->app->alias(ClientContract::class, 'logsnag');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\InstallCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/logsnag.php' => config_path('logsnag.php'),
            ], 'logsnag-config');
        }
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'logsnag',
            ClientContract::class,
        ];
    }
}
