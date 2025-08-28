<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'name',
        'description',
        'category_author',
        'image',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'slug',
        'active',
        'article_count'
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
