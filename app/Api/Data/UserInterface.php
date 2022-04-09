<?php
declare(strict_types=1);

namespace App\Api\Data;

interface UserInterface
{
    const ID                    = 'id';
    const NAME                  = 'name';
    const EMAIL                 = 'email';
    const PASSWORD              = 'password';
    const PASSWORD_CONFIRMATION = 'password_confirmation';
    const TOKENS                = 'tokens';

    const LOGOUT_MESSAGE = 'You successfully logged out';
    const PASSWORD_NOT_PASSED_MESSAGE = 'Password not passed';
    const REFRESH_TOKEN_NOT_PASSED_MESSAGE = 'Refresh token not passed';
}