<?php

namespace App\Providers;

use App\Service\Config\PassportConfig;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /*** @var PassportConfig */
    private $passportConfig;

    public function __construct($app)
    {
        parent::__construct($app);
        $this->passportConfig = app(PassportConfig::class);
    }

    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensExpireIn(now()->addDays($this->passportConfig->getAccessTokenExpireIn()));
        Passport::refreshTokensExpireIn(now()->addDays($this->passportConfig->getRefreshTokenExpireIn()));
    }
}
