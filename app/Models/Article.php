<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $primaryKey = 'article_id';
    protected $fillable = ['title', 'slug', 'content', 'image', 'category_id', 'writer_id' , 'published_at' , 'notebook' , 'status' , 'note_date'];

    public static function getLimitArticles($n)
    {
        return self::orderBy('created_at', 'DESC')->take($n)->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'article_id', 'article_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'writer_id', 'user_id');
    }

}
