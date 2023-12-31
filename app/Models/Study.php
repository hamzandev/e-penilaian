<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{

    use HasFactory;
      
    protected $fillable = ['kelas_id', 'subject_id', 'teacher_id', 'standard'];

    function kelas()
    {
        return $this->hasOne(Kelas::class);
    }

    function subject()
    {
        return $this->hasOne(Subject::class);
    }

    function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
