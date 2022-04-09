<?php
declare(strict_types=1);

namespace App\Http\Controllers\Authorization;

use App\Api\Data\HTTP_STATUS;
use App\Http\Controllers\Controller;

class TokenRefreshController extends Controller
{
    private $oathTokenGenerator;

    public function __construct(
        \App\Service\Authorization\OathTokenGenerator $oathTokenGenerator
    ) {
        $this->oathTokenGenerator = $oathTokenGenerator;
    }

    public function tokenRefresh(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json($this->oathTokenGenerator->regenerateRefreshToken());
        } catch (\Exception $exception) {
            return response()->json(['error' => __(HTTP_STATUS::PHRASES[HTTP_STATUS::UNAUTHORIZED])], HTTP_STATUS::UNAUTHORIZED);
        }
    }
}
