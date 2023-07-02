<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveEmployeeRequest;
use App\Http\Requests\SaveSkillsRequest;
use App\Models\Employees;
use App\Models\EmployeesSkills;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Validator;
class EmployeesController extends Controller
{
    public function index(){
        $employees = Employees::with(['employeesSkils'])->get();
        throw_if(empty($employees), new HttpException(404, 'No se encontraron empleados'));
        return $employees;
    }

    public function show(int $id){
        $employee = Employees::where('id', $id)->with(['employeesSkils'])->first();
        throw_if(!$employee, new HttpException(404, 'No se encontraron empleado con el id'. $id));
        return $employee;
    }


    public function store(SaveEmployeeRequest $request){

        foreach ($request->skills as $skill) {
            Validator::validate($skill, SaveSkillsRequest::rules());
        }
        $date = Carbon::createFromFormat('d/m/Y',$request->birthdate)->format('Y-m-d');
        $employe = Employees::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'position'  => $request->position,
            'birthdate' => $date,
            'address'   => $request->address,
        ]);
        $skills = [];

        foreach ($request->skills as $skill){
            $skill = EmployeesSkills::create([
                'employee_id' => $employe->getKey(),
                'nameSkill'   => $skill['nameSkill'],
                'rank'        => $skill['rank']
            ]);
            $skills[] = $skill;
        }

        return [
            'success' => 'success',
            'employee' => $employe,
            'skills' => $skills
        ];
    }

//    public function update(int $id, Request $request){
//
//    }
//
//    public function destroy(int $id){
//
//    }



}
