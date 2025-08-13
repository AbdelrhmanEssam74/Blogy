<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'comment_id';
    protected $fillable = [
        'comment_id',
        'content',
        'article_id',
        'user_id',
        'status',];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'article_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id', 'user_id');
    }
}

