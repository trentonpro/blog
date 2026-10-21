<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;
<<<<<<< HEAD
}
=======

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
>>>>>>> 83a15dc86e24ae1c8e4859fff5071065c75f580e
