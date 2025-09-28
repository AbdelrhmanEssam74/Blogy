<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WriterProfile extends Model
{
    protected $casts = [
        'social_media_links' => 'array',
    ];

    protected $fillable = [
        'user_id',
        'bio',
        'website',
        'profile_picture',
        'social_media_links',
        'status',
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
