<?php

declare(strict_types=1);

namespace App\Comments\Controllers;

use App\Chats\Transformers\ChatTransformer;
use Domain\Chats\Models\Chat;

class GetCommentsController
{
    public function __invoke()
    {
        $chats = Chat::with(['comments', 'comments.user'])->get();

        return responder()->success($chats, ChatTransformer::class)->respond();
    }
}
