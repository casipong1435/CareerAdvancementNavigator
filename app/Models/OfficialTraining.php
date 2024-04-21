<?php

namespace App\Models;

use App\Models\AttendedTraining;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'training_title',
        'start_of_conduct',
        'end_of_conduct',
        'number_of_hours',
        'type_of_ld',
        'source_of_budget',
        'conducted_by',
        'service_provider',
        'status',
        'responsible_unit',
        'number_of_participants',
        'venue',
        'training_type',
        'reference'
    ];

    public function attendedTrainings()
    {
        return $this->hasMany(AttendedTraining::class, 'training_id', 'training_id');
    }

}
