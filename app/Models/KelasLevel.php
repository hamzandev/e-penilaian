<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasLevel extends Model
{

    use HasFactory;
    protected $fillable = ['level'];

    function kelas() {
        return $this->belongsTo(Kelas::class);
    }
}
