<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'nuptk', 'user_id', 'name', 'dob', 'gender', 'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function study()
    {
        return $this->hasMany(Study::class);
    }

    public function subject()
    {
        return $this->hasMany(Study::class);
    }
}
