<?php

namespace Modules\Auth\Services;

use Modules\Auth\Actions\ConfirmPasswordAction;
use Modules\Auth\Services\Contracts\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private ConfirmPasswordAction $confirmPasswordAction
    ) {}

    public function confirmPassword($user, string $password)
    {
        return $this->confirmPasswordAction->execute($user, $password);
    }
}
