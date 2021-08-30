<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public function subgenre(){
        return $this->hasMany(Genre::class, 'parent_id');
    }

    public function parent(){
        return $this->belongsTo(Genre::class, 'parent_id');
    }
}
