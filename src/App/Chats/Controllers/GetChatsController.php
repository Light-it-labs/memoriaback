<?php

declare(strict_types=1);

namespace App\Chats\Controllers;

use App\Chats\Transformers\ChatTransformer;
use Domain\Chats\Models\Chat;

class GetChatsController
{
    public function __invoke()
    {
        $chats = Chat::with(['comments', 'comments.user'])->get();

        return responder()->success($chats, ChatTransformer::class)->respond();
    }
}
