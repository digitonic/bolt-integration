<?php

namespace Digitonic\Bolt;

use Digitonic\Bolt\Services\BoltClient;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class BoltServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__ . '/../config/config.php' => App::configPath('digitonic.bolt'),
                ],
                'config'
            );
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'digitonic.bolt');
        $this->app->bind(
            BoltClient::class,
            function ($app) {
                return new BoltClient(
                    new Client(
                        [
                            'base_uri' => config('digitonic.bolt.api_endpoint'),
                            'headers' => [
                                'Authorization' => ['Bearer ' . config('digitonic.bolt.bearer_token')],
                                'Content-Type' => ['application/json'],
                                'Accept' => ['application/json']
                            ]
                        ]
                    )
                );
            }
        );
    }
}
