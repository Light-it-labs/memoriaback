<?php

declare(strict_types=1);

namespace Domain\Comments\Models;

use App\Scopes\ApprovedScope;
use Domain\Chats\Models\Chat;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Domain\Comments\Models\Comment
 *
 * @property int $id
 * @property int $chat_id
 * @property int $user_id
 * @property string $body
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @property-read Chat $chat
 * @property-read User $user
 * @property int|null $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $childComments
 * @property-read int|null $child_comments_count
 * @property-read Comment|null $parentComment
 * @method static \Illuminate\Database\Eloquent\Builder|Comment approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $guarded = [];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new ApprovedScope);
    }
}
