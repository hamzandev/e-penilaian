<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolyear extends Model
{
<<<<<<< Updated upstream
    use HasFactory;
=======

    use HasFactory;
    protected $fillable = ['start_year', 'end_year', 'semester_type', 'description'];
>>>>>>> Stashed changes

    function kelas() {
        return $this->belongsTo(Kelas::class);
    }

}
