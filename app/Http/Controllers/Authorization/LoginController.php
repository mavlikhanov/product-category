<?php
declare(strict_types=1);

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\LoginRequest;
use App\Http\Resources\Authorization\AuthorizationResource;

class LoginController extends Controller
{
    private $authorizationService;

    public function __construct(
        \App\Service\Authorization\AuthorizationService $authorizationService
    ) {
        $this->authorizationService = $authorizationService;
    }

    public function login(LoginRequest $request)
    {
        return $this->authorizationService->login($request->only('email', 'password'));
    }
}
