<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    public function ChillCategory( )
    {
        return $this->hasMany(Category::class,'father_id');
    }

    public function ParentCategory( )
    {
        return $this->belongsTo(Category::class,'father_id','id');
    }

    protected $fillable = [
        'name',
        'father_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
