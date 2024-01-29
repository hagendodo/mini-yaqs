<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuoteCategory extends Model
{
    use HasFactory;
    protected $table = 'quote_categories';
    protected $fillable = ['name'];
}
