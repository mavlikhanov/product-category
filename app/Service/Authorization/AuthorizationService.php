<?php
declare(strict_types=1);

namespace App\Service\Authorization;

use App\Api\Data\HTTP_STATUS;
use App\Http\Resources\Authorization\AuthorizationResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthorizationService
{
    public function login(array $credentials)
    {
        try {
            auth()->guard('api')->attempt($credentials);
        } catch (\Exception $exception) {
            return $this->getUnauthorizedResponse();
        }
        $user = User::email($credentials['email'])->firstOrFail();
        return new AuthorizationResource($user);
    }

    private function getUnauthorizedResponse(): JsonResponse
    {
        return response()->json(['error' => __(HTTP_STATUS::PHRASES[HTTP_STATUS::UNAUTHORIZED])], HTTP_STATUS::UNAUTHORIZED);
    }
}