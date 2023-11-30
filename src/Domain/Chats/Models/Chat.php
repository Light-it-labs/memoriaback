<?php

declare(strict_types=1);

namespace Domain\Chats\Models;

use Domain\Comments\Models\Comment;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Domain\Chats\Models\Chat
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comment> $comments
 * @property-read int|null $comments_count
 * @property string $description
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUserId($value)
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereTitle($value)
 * @mixin \Eloquent
 */
class Chat extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
