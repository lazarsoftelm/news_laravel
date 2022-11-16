<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'news_text',
        'categorie_id',
        'slug'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comments::class)->withTimestamps();
    }

    public function savedByUser()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
