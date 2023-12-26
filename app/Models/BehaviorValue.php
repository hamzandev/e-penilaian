<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorValue extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'predicate', 'behavior_type', 'description'];

    function student() {
        return $this->belongsTo(Student::class);
    }
}
