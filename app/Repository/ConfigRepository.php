<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\Config;

class ConfigRepository
{
    public function getValue(string $path): ?string
    {
        return $this->getConfig($path)->value ?? null;
    }

    public function save(string $path, string $value): void
    {
        $config = $this->getConfig($path);
        if (!$config || $config->isEmpty()) {
            return;
        }
        $config->value = $value;
        $config->save();
    }

    private function getConfig(string $path): ?Config
    {
        return Config::where('path', $path)->first();
    }
}
