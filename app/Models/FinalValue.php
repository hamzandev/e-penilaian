<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalValue extends Model
{
    use HasFactory;
<<<<<<< Updated upstream
=======
    protected $fillable = ['student_id', 'knowledge', 'ability', 'pts', 'pas', 'average'];
>>>>>>> Stashed changes

    function student() {
        return $this->belongsTo(Student::class);
    }
}
