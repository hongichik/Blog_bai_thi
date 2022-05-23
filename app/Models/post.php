<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\category;

class post extends Model
{
    use HasFactory;
    protected $fillable = [
        'summany',
        'name',
        'image',
        'user_id',
        'category_id',
    ];
}
