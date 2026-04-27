<?php

namespace Modules\Auth\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ConfirmPasswordAction
{
    public function execute($user, string $password)
    {
        if (! Auth::guard('web')->validate([
            'email' => $user->email,
            'password' => $password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }
    }
}
