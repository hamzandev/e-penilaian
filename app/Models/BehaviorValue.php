<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorValue extends Model
{
    use HasFactory;

    function student() {
        return $this->belongsTo(Student::class);
    }
}
