<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GadAssessmentQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'year',
        'status'
    ];
}
