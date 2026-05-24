<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nota extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'contenido', 'categoria', 'fijada'];

    protected $casts = [
        'fijada' => 'boolean',
    ];
}
