<?php

namespace App\Models;

use App\Models\OfficialTraining;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendedTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'training_id',
        'cop',

    ];

    public function officialTraining()
    {
        return $this->belongsTo(OfficialTraining::class);
    }

    public function employee()
    {
        return $this->belongsTo(Profiles::class, 'employee_id', 'employee_id');
    }
}
