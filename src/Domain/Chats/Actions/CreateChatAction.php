<?php

declare(strict_types=1);

namespace Domain\Chats\Actions;

use Domain\Chats\Models\Chat;

class CreateChatAction
{
    public function __invoke($data)
    {
        return Chat::create($data);
    }
}
