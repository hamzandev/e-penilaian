<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasLevel extends Model
{
<<<<<<< Updated upstream
    use HasFactory;
=======

    use HasFactory;
    protected $fillable = ['level'];
>>>>>>> Stashed changes

    function kelas() {
        return $this->belongsTo(Kelas::class);
    }
<<<<<<< Updated upstream
}
=======
}
>>>>>>> Stashed changes
