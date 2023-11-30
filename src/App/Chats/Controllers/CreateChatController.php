<?php

declare(strict_types=1);

namespace App\Chats\Controllers;

use App\Chats\Transformers\ChatTransformer;
use Domain\Chats\Actions\CreateChatAction;
use Illuminate\Http\Request;

class CreateChatController
{
    public function __invoke(Request $request, CreateChatAction $createChatAction)
    {
        $data = [
            'name' => $request->input('name'),
        ];

        $chat = $createChatAction($data);

        return responder()->success($chat, ChatTransformer::class)->respond();
    }
}
