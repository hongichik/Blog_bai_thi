<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitorWeb extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'count'
    ];
}
