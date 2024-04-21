<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'employee_id',
        'training_id',
        'training_title',
        'start_of_conduct',
        'end_of_conduct',
        'number_of_hours',
        'type_of_ld',
        'source_of_budget',
        'conducted_by',
        'service_provider',
        'responsible_unit',
        'cop',
        'number_of_participants',
        'venue',
        'training_type',
        'reference'
    ];

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn($value) => ['pending', 'rejected'][$value],
        );
    }
}
