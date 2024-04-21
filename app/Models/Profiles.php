<?php

namespace App\Models;

use App\Models\AttendedTraining;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'age',
        'sex',
        'mobile_number',
        'image',
        'district',
        'date_started_in_deped',
        'years_in_service',
        'school',
        'pwd'
    ];

    public function attendedTrainings()
    {
        return $this->hasMany(AttendedTraining::class, 'employee_id', 'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'employee_id');
    }
}
