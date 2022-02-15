<?php

namespace App\Contracts;


use App\Http\Requests\DepartmentRequest;
use App\Models\Department;

interface DepartmentRepositoryInterface
{
    public function allDepartments();

    public function showDepartment($id);

    public function createDepartment(DepartmentRequest $request);

    public function updateDepartment(DepartmentRequest $request, Department $department);

    public function deleteDepartment(Department $department);
}
