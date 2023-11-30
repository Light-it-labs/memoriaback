<?php

declare(strict_types=1);

namespace App\Chats\Transformers;

use App\Comments\Transformers\CommentTransformer;
use App\Users\Transformers\UserTransformer;
use Domain\Chats\Models\Chat;
use Flugg\Responder\Transformers\Transformer;

class ChatTransformer extends Transformer
{
    public function transform(Chat $chat)
    {
        $chat->load(['user', 'comments']);

        return [
            'id' => $chat->id,
            'title' => $chat->title,
            'description' => $chat->description,
            'user' => (new UserTransformer())->transform($chat->user),
            'comments' => $chat->relationLoaded('comments') ? $chat->comments->map(
                fn ($comment) => (new CommentTransformer())->transform($comment)
            )->toArray() : null,
            'created_at' => $chat->created_at->toDateTimeString(),
        ];
    }
}
