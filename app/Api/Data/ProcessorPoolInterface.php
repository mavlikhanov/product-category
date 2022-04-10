<?php
declare(strict_types=1);

namespace App\Api\Data;

interface ProcessorPoolInterface
{
    public function getProcessors(): array;
}