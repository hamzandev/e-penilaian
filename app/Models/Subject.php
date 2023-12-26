<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    use HasFactory;

    function grade() {
        return $this->hasMany(Grade::class);
    }

    function study() {
        return $this->hasMany(Study::class);
    }

    function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
