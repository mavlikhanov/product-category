<?php
declare(strict_types=1);

namespace App\Api\Data;

interface ParserDiInterface
{
    public function matchProcessors(): array;
}