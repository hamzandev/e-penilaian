<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
<<<<<<< Updated upstream
=======
    protected $fillable = ['student_id', 'type', 'description'];
>>>>>>> Stashed changes

    function student() {
        return $this->belongsTo(Student::class);
    }
<<<<<<< Updated upstream
}
=======
}
>>>>>>> Stashed changes
