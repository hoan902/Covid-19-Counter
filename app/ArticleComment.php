<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
