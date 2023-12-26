<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorValue extends Model
{
    use HasFactory;
<<<<<<< Updated upstream
=======
    protected $fillable = ['student_id', 'predicate', 'behavior_type', 'description'];
>>>>>>> Stashed changes

    function student() {
        return $this->belongsTo(Student::class);
    }
}
