<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precense extends Model
{
<<<<<<< Updated upstream
    use HasFactory;
=======

    use HasFactory;
    protected $fillable = ['student_id', 'sick', 'permit', 'absent'];
>>>>>>> Stashed changes

    function student() {
        return $this->belongsTo(Student::class);
    }
}
