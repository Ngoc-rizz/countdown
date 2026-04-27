<?php

namespace Modules\Auth\Services\Contracts;

interface AuthServiceInterface
{
    public function confirmPassword($user, string $password);
}
