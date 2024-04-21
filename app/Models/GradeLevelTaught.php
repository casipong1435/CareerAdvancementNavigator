<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeLevelTaught extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'grade_level',
        'from',
        'to'
    ];
}
