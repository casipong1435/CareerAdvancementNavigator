<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'subject_area',
        'position',
        'sex',
        'age',
        'category',
        'level'
    ];
}
