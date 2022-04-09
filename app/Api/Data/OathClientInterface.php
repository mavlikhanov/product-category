<?php
declare(strict_types=1);

namespace App\Api\Data;

use Illuminate\Database\Eloquent\Model;

interface OathClientInterface
{
    public function getClient(): Model;
}