<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'otp',
        'status',
        'date_created'

    ];
}
