<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GadAssessmentAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'question_id',
        'date_answered'
    ];
}
