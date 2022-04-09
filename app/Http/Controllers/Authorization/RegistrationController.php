<?php
declare(strict_types=1);

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authorization\RegistrationRequest;
use App\Http\Resources\Authorization\AuthorizationResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request): AuthorizationResource
    {
        return new AuthorizationResource(User::create($request->all()));
    }
}
