<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistorpost extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'count',
        'post_id'
    ];
}
