<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    use HasFactory;
    protected $table = 'video_categories';
    protected $fillable = ['name'];
}
