<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLike extends Model
{
    use HasFactory;
    protected $table = 'video_likes';
    protected $fillable = [
        'ip',
        'video_id'
    ];
}
