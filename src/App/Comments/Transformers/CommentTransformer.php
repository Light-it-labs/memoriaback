<?php

declare(strict_types=1);

namespace App\Comments\Transformers;

use Domain\Comments\Models\Comment;
use Flugg\Responder\Transformers\Transformer;

class CommentTransformer extends Transformer
{
    public function transform(Comment $comment)
    {
        $comment->load(['comments']);
        logger($comment->comments);
        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'status' => $comment->status,
            'user' => [
                'id' => $comment->user->id,
                'name' => $comment->user->name,
            ],
            'comments' => $comment->comments->map(
                fn ($comment) => (new CommentTransformer())->transform($comment)
            )->toArray(),
        ];
    }
}
