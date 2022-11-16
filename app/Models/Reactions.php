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

    // public function reactedOnNews()
    // {
    //     return $this->belongsToMany(News::class, 'news_reaction')->withTimestamps();
    // }
}
