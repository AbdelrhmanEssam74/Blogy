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
    ];
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
