<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Config;
use App\Service\Config\PassportConfig;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $configParameters = $this->getData();
        if (!$configParameters) {
            return;
        }
        foreach ($configParameters as $configParameter) {
            Config::firstOrCreate(
                ['path' => $configParameter['path']],
                ['value' => $configParameter['value']]
            );
        }
    }

    public function getData(): array
    {
        return [
            $this->getPreparedData(PassportConfig::PASSPORT_ACCESS_TOKEN_EXPIRE_IN, '15'),
            $this->getPreparedData(PassportConfig::PASSPORT_REFRESH_TOKEN_EXPIRE_IN, '30'),
        ];
    }

    private function getPreparedData(string $path, string $value): array
    {
        return [
            'path' => $path,
            'value' => $value,
        ];
    }
}
