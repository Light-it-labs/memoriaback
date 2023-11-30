<?php

declare(strict_types=1);

namespace App\Users\Controllers;

use App\Users\Transformers\UserTransformer;
use Domain\Users\Actions\LoginAction;
use Illuminate\Http\Request;

class LoginController
{
    public function __invoke(Request $request, LoginAction $loginAction)
    {
        $user = $loginAction($request);

        $token = $user->createToken('login')->plainTextToken;
        return responder()->success($user, UserTransformer::class)->meta(['token' => $token])->respond();
    }
}
