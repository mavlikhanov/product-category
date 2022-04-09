<?php
declare(strict_types=1);

namespace App\Service\Authorization\Transport;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client;

class PassportClient implements \App\Api\Data\OathClientInterface
{
    public function getClient(): Model
    {
        return Client::where('password_client', 1)->first();
    }
}