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
        $token = $this->userRepo->register($request);
        return response()->json(['token' => $token], 200);
    }

    public function login(UserRequest $request)
    {
        $this->userRepo->login($request);
    }
}
