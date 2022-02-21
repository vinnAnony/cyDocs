<?php
namespace App\Repositories;

use App\Console\Commands\TwelveHourNotification;
use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;
use App\Mail\CyDocsMail;
use App\Models\Department;
use App\Models\FileRequest;
use App\Notifications\TwelveHourEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function allDepartments()
    {
        return Department::all();
    }

    public function showDepartment($id)
    {
        return Department::where('id', '=', $id)->first();
    }

    public function createDepartment(DepartmentRequest $request)
    {
        return Department::create($request->all());
    }

    public function updateDepartment(DepartmentRequest $request, Department $department)
    {
         return $department->update($request->all());
    }

    public function deleteDepartment($departmentId)
    {
        return $department = Department::where('id',$departmentId)->delete();
    }

    public function fetchDepartmentDocuments($id)
    {
        return Department::where('id', $id)->with('documents')->get();
    }
}
