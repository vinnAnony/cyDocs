<?php

namespace App\Contracts;


use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function allUsers();

    public function showUser($id);

    public function createUser(UserRequest $request);

    public function register(UserRequest $request);

    public function login(Request $request);

    public function updateUser(Request $request, User $user);

    public function deleteUser(User $user);
}
