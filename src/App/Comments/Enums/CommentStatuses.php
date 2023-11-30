<?php

declare(strict_types=1);

namespace App\Comments\Enums;

enum CommentStatuses: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
