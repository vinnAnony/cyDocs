<?php
namespace App\Repositories;

use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;

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

    public function deleteDepartment(Department $department)
    {
        /** @var TYPE_NAME $department */
        return $department->delete($department);
    }
}
