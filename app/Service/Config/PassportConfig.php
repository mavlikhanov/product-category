<?php
declare(strict_types=1);

namespace App\Service\Config;

class PassportConfig extends AbstractConfig
{
    const PASSPORT_ACCESS_TOKEN_EXPIRE_IN = 'passport/access_token/expire/in';
    const PASSPORT_REFRESH_TOKEN_EXPIRE_IN = 'passport/refresh_token/expire/in';

    const PASSPORT_ACCESS_TOKEN_DEFAULT = 15;
    const PASSPORT_REFRESH_TOKEN_DEFAULT = 30;

    public function getAccessTokenExpireIn(): int
    {
        $accessToken = (int)$this->configRepository->getValue(self::PASSPORT_ACCESS_TOKEN_EXPIRE_IN);
        return $accessToken ?? self::PASSPORT_ACCESS_TOKEN_DEFAULT;
    }

    public function getRefreshTokenExpireIn(): int
    {
        $accessToken = (int)$this->configRepository->getValue(self::PASSPORT_REFRESH_TOKEN_EXPIRE_IN);
        return $accessToken ?? self::PASSPORT_REFRESH_TOKEN_DEFAULT;
    }
}