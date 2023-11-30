<?php

declare(strict_types=1);

namespace App\Comments\Controllers;

use App\Comments\Transformers\CommentTransformer;
use Domain\Comments\Actions\CreateCommentAction;
use Illuminate\Http\Request;

class CreateCommentController
{
    public function __invoke(Request $request, CreateCommentAction $createCommentAction)
    {
        $data = [
            'body' => $request->input('body'),
            'user_id' => $request->user()->id,
            'chat_id' => $request->input('chat_id'),
            'parent_id' => $request->input('comment_id'),
        ];

        $chat = $createCommentAction($data);

        return responder()->success($chat, CommentTransformer::class)->respond();
    }
}
