<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function study()
    {
        return $this->hasMany(Study::class);
    }

    public function schoolyear()
    {
        return $this->belongsTo(Schoolyear::class);
    }

    // suatu kelas punya walikelas
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function kelasLevel()
    {
        return $this->belongsTo(KelasLevel::class);
    }
}
