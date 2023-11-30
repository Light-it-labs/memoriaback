<?php

declare(strict_types=1);

namespace App\Comments\Transformers;

use Domain\Comments\Models\Comment;
use Flugg\Responder\Transformers\Transformer;

class CommentTransformer extends Transformer
{
    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'body' => $comment->body,
            'status' => $comment->status,
            'user' => [
                'id' => $comment->user->id,
                'name' => $comment->user->name,
            ],
            'comments' => $comment->childComments->map(
                fn ($comment) => (new CommentTransformer())->transform($comment)
            )->toArray(),
        ];
    }
}
