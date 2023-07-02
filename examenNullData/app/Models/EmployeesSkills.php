<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesSkills extends Model
{
    use HasFactory;

    protected $table = 'employees_skills';

    protected $fillable = [
        'employee_id', 'nameSkill', 'rank'
    ];

    public function employee()
    {
        return $this->hasOne(Employees::class, 'id', 'employee_id');
    }
}
