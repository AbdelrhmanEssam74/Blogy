<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image'];
    public static function getLimitArticles($n)
    {
        return self::orderBy('created_at', 'DESC')->take($n)->get();
    }
}
