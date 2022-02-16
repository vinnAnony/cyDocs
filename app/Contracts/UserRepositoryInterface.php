<?php

namespace App\Contracts;


use App\Http\Requests\UserRequest;
use App\User;

interface UserRepositoryInterface
{
    public function allUsers();

    public function showUser($id);

    public function createUser(UserRequest $request);

    public function register(UserRequest $request);

    public function login(UserRequest $request);

    public function updateUser(UserRequest $request, User $user);

    public function deleteUser(User $user);
}
