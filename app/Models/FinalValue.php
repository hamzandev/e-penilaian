<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalValue extends Model
{
    protected $table = 'final_values';
    protected $fillable = ['student_id', 'knowledge', 'ability', 'pts', 'pas', 'average'];

    public function student()
    {
       return $this->belongsTo(Student::class, 'student_id');
    }
}
