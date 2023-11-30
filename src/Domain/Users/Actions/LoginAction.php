<?php

declare(strict_types=1);

namespace Domain\Users\Actions;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginAction
{
    public function __invoke($data)
    {
        if (Auth::attempt(['email' => $data->input('email'), 'password' => $data->input('password')])) {
            Session::regenerate();

            /** @var User $user */
            $user = Auth::user();

            return $user;
        }
        throw new Exception('Invalid credentials');
    }
}
