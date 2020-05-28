<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function likeComments()
    {
        return $this->hasMany(LikeComment::class);
    }

    public function likecmt($user = null, $liked = true)
    {
        $this->likeComments()->updateOrCreate(
            [
                'user_id' => $user ? $user->id : auth()->id(),
            ],
            [
                'liked' => $liked,
            ]
        );
    }
    public function dislikecmt($user = null)
    {
        return $this->likecmt($user, false);
    }
    public function scopeWithLikeComments(Builder $query)
    {
        $query->leftJoinSub(
            'select comment_id, sum(liked) likes_comment, sum(!liked) dislikes_comment from like_comments group by comment_id',
            'like_comments',
            'like_comments.comment_id',
            'comments.id'
        );
    }
    public function isLikedBy(User $user)
    {
        return (bool) $user->likeComments()
            ->where('comment_id', $this->id)
            ->where('Liked', true)
            ->count();
    }
    public function isDislikedBy(User $user)
    {
        return (bool) $user->likeComments()
            ->where('comment_id', $this->id)
            ->where('Liked', false)
            ->count();
    }
}
