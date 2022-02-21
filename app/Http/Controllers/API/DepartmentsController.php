<?php

namespace App\Http\Controllers\API;

use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Controllers\Controller;
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
        return response()->json([
            'success' =>true,
            'message' => $department->department_name.' successfully created'
        ], 201);
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

    public function destroy($departmentId)
    {
        $response = $this->departmentRepo->deleteDepartment($departmentId);
        if ($response){
            return response()->json([
                'success' => true,
                'message' => 'Deleted successfully'
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'An error occurred. Please try again.'
            ], 200);
        }
    }

}
