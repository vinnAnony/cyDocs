<?php

namespace App\Http\Controllers\API;

use App\Contracts\DocumentRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
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
}
