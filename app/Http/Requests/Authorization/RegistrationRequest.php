<?php
declare(strict_types=1);

namespace App\Http\Requests\Authorization;

use App\Api\Data\UserInterface;
use App\Http\Requests\Request;

class RegistrationRequest extends Request
{
    public function rules(): array
    {
        return [
            UserInterface::NAME                   => 'required|max:255',
            UserInterface::EMAIL                  => 'required|email|unique:users|max:255',
            UserInterface::PASSWORD               => 'required|min:5|max:50|confirmed',
            UserInterface::PASSWORD_CONFIRMATION  => 'required|min:5|max:50'
        ];
    }

    public function attributes(): array
    {
        return [
            UserInterface::EMAIL                  => __('auth.' . UserInterface::EMAIL),
            UserInterface::PASSWORD               => __('auth.auth_' . UserInterface::PASSWORD),
            UserInterface::PASSWORD_CONFIRMATION  => __('auth.' . UserInterface::PASSWORD_CONFIRMATION),
        ];
    }
}
