<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name', 'email', 'position', 'birthdate', 'address'
    ];

    public function employeesSkils()
    {
        return $this->hasMany(EmployeesSkills::class, 'employee_id', 'id');
    }

}
