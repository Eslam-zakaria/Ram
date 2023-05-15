<?php

namespace Modules\Comment\Models;

use Eloquent;
use Modules\Blog\Models\Blog;
use Modules\Comment\Constants\CommentStatus;

class Comment extends Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'blog_id', 'commenter', 'email', 'content', 'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    protected $appends =[
        'statusLabel'
    ];

    public function getStatusLabelAttribute()
    {
        return CommentStatus::getLabel($this->status);
    }
}
