<?php

declare(strict_types=1);

namespace Domain\Comments\Actions;

use Domain\Comments\Models\Comment;

class CreateCommentAction
{
    public function __invoke($data)
    {
        return Comment::create($data);
    }
}
