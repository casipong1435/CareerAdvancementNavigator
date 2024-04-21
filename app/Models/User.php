<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'position',
        'category',
        'status',
        'password',
        'plain_pass',
        'role',
        'email',
        'job_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected function role(): Attribute
    {
        return new Attribute(
            get: fn($value) => ['user', 'admin'][$value],
        );
    }

    protected function status(): Attribute
    {
        return new Attribute(
            get: fn($value) => ['pending', 'official', 'rejected'][$value],
        );
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'employee_id', 'employee_id');
    }

    public function salaryGrade()
    {
        return $this->hasOne(SalaryGrade::class, 'position', 'position');
    }
}
