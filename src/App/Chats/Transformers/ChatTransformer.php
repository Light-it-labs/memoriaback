<?php

declare(strict_types=1);

namespace App\Chats\Transformers;

use App\Comments\Transformers\CommentTransformer;
use Domain\Chats\Models\Chat;
use Flugg\Responder\Transformers\Transformer;

class ChatTransformer extends Transformer
{
    public function transform(Chat $chat)
    {
        return [
            'id' => $chat->id,
            'name' => $chat->name,
            'comments' => $chat->relationLoaded('comments') ? $chat->comments->map(
                fn ($comment) => (new CommentTransformer())->transform($comment)
            )->toArray() : null,
        ];
    }
}
