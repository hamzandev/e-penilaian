<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $table = 'achievements';
    protected $fillable = ['student_id', 'type', 'description'];

   
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
