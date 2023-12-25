<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorValue extends Model
{
    protected $table = 'behavior_values';
    protected $fillable = ['student_id', 'predicate', 'behavior_type', 'description'];

    public function student()
    {
      return $this->belongsTo(Student::class, 'student_id');
    }
}
