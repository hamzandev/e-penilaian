<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precense extends Model
{
    protected $table = 'precenses';
    protected $fillable = ['student_id', 'sick', 'permit', 'absent'];

    
    public function student()
    {
       return $this->belongsTo(Student::class, 'student_id');
    }
}

