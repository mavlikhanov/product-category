<?php
declare(strict_types=1);

namespace App\Http\Controllers\Authorization;

use App\Api\Data\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::user()->token()->revoke();
        return response()->json(['message' => __(UserInterface::LOGOUT_MESSAGE)]);
    }
}
