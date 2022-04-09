<?php

namespace App\Providers;

use App\Api\Data\OathClientInterface;
use App\Service\Authorization\Transport\PassportClient;
use Illuminate\Support\ServiceProvider;

class OathServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OathClientInterface::class, PassportClient::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
