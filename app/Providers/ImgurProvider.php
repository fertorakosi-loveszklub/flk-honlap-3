<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Imgur\Client;

class ImgurProvider extends ServiceProvider
{
    public $defer = true;

    public function provides()
    {
        return [Client::class];
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Client::class, function () {
            $client = new Client();
            $client->setOption('client_id', env('IMGUR_CLIENT_ID'));
            $client->setOption('client_secret', env('IMGUR_SECRET'));

            return $client;
        });
    }
}
