<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nisn', 'kelas_id', 'dob', 'gender', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function achievement()
    {
        return $this->hasMany(Achievement::class);
    }

    public function finalValue()
    {
        return $this->hasOne(FinalValue::class);
    }

    public function behaviorValue()
    {
        return $this->hasMany(BehaviorValue::class);
    }

    public function precense()
    {
        return $this->hasMany(Precense::class);
    }
}
