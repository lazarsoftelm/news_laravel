<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emoji extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'short_name'
    ];

    public function reactions()
    {
        return $this->hasMany(Reactions::class, 'reactions')->withTimestamps();
    }
}
