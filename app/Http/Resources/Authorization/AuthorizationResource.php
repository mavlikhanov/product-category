<?php
declare(strict_types=1);

namespace App\Http\Resources\Authorization;

use App\Api\Data\UserInterface;
use App\Service\Authorization\OathTokenGenerator;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorizationResource extends JsonResource
{
    /*** @var OathTokenGenerator */
    private $oathTokenService;

    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->oathTokenService = app(OathTokenGenerator::class);
    }

    public function toArray($request): array
    {
        return [
            UserInterface::ID        => $this->id,
            UserInterface::NAME      => $this->name,
            UserInterface::TOKENS    => $this->oathTokenService->tokensGenerate($this)
        ];
    }
}
