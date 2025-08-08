<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $primaryKey = 'article_id';
    protected $fillable = ['title', 'slug', 'content', 'image', 'category_id', 'writer_id'];

    public static function getLimitArticles($n)
    {
        return self::orderBy('created_at', 'DESC')->take($n)->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
