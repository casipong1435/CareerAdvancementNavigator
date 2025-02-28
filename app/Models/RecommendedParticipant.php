<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendedParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'training_id',
        'recommended_by',
    ];
}
