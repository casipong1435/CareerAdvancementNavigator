<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectedParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'training_id'
    ];
}
