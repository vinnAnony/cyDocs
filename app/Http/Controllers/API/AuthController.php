<?php

namespace App\Http\Controllers\API;

use App\Contracts\DocumentRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function fetchAllUsers()
    {
        $response = $this->userRepo->allUsers();
        return response()->json($response);
    }

    public function updateUser(Request $request, User $user)
    {
        $response = $this->userRepo->updateUser($request, $user);
        if ($response){
            return response()->json([
                'success' => true,
                'message' => 'User info updated'
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'An error occurred'
            ],200);
        }
    }

    public function register(UserRequest $request)
    {
        $response = $this->userRepo->register($request);
        return response()->json($response);
    }

    public function login(Request $request)
    {
        $response = $this->userRepo->login($request);
        return response()->json($response);
    }
    public function fetchUserRoles()
    {
        $response = $this->userRepo->allUserRoles();
        return response()->json($response);
    }
    public function addUserRole(RoleRequest $request)
    {
        $role = $this->userRepo->createUserRole($request);
        return response()->json($role, 201);
    }

    public function destroy($userId)
    {
        $response = $this->userRepo->deleteUser($userId);
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
