<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'news_id',
        'emoji_id'
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users')->withTimestamps();
    }

    public function emoji()
    {
        return $this->belongsTo(Emoji::class, 'emoji')->withTimestamps();
    }
}
