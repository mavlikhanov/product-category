<?php
declare(strict_types=1);

namespace App\Http\Requests\Authorization;

use App\Api\Data\UserInterface;
use App\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules(): array
    {
        return [
            UserInterface::EMAIL    => 'required',
            UserInterface::PASSWORD => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            UserInterface::EMAIL    => __('auth.' . UserInterface::EMAIL),
            UserInterface::PASSWORD => __('auth.auth_' . UserInterface::PASSWORD),
        ];
    }
}
