<?php
declare(strict_types=1);

namespace App\Service\Config;

abstract class AbstractConfig
{
    protected $configRepository;

    public function __construct(
        \App\Repository\ConfigRepository $configRepository
    ) {
        $this->configRepository = $configRepository;
    }
}