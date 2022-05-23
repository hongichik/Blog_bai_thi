<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postChilld extends Model
{
    use HasFactory;
    protected $fillable = [
        'summany',
        'name',
        'image',
        'user_id',
        'post_id',
        'content'
    ];
}
