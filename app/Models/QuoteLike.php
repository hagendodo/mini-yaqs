<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteLike extends Model
{
    use HasFactory;
    protected $table = 'quote_likes';
    protected $fillable = [
        'ip',
        'quote_id'
    ];
}
