<?php

declare(strict_types=1);

namespace App\Chats\Controllers;

use App\Chats\Transformers\ChatTransformer;
use Domain\Chats\Models\Chat;

class GetChatController
{
    public function __invoke(Chat $chat)
    {
        return responder()->success($chat, ChatTransformer::class)->respond();
    }
}
