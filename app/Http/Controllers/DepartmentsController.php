<?php

namespace App\Http\Controllers;

use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentsController extends Controller
{
    protected $departmentRepo;

    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    public function index()
    {
        $departments = $this->departmentRepo->allDepartments();
        return response()->json($departments, 200);
    }

    public function store(DepartmentRequest $request)
    {
        $department = $this->departmentRepo->createDepartment($request);
        return response()->json($department, 201);
    }

    public function show($id)
    {
        $department = $this->departmentRepo->showDepartment($id);
        return response()->json($department, 200);
    }

    public function update(DepartmentRequest $request, Department $department)
    {
        $this->departmentRepo->updateDepartment($request, $department);
        return response()->json($department, 200);
    }

    public function destroy(Department $department)
    {
        $department = $this->departmentRepo->deleteDepartment($department);
        return response()->json($department, 200);
    }

    public function fetchDepartmentCategories($id)
    {
        $department = $this->departmentRepo->fetchDepartmentCategories($id);
        return response()->json($department, 200);
    }

    public function fetchDepartmentDocuments($id)
    {
        $department = $this->departmentRepo->fetchDepartmentDocuments($id);
        return response()->json($department, 200);
    }
}
