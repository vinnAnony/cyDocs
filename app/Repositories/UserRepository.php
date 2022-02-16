<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::all();
    }

    public function showUser($id)
    {
        return User::where('id', '=', $id)->first();
    }

    public function createUser(UserRequest $request)
    {
        return User::create($request->all());
    }

    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $user->createToken('CyDocsToken')->accessToken;
    }

    public function login(UserRequest $request)
    {
        $request = $request->except(['name']);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('CyDocsToken')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function updateUser(UserRequest $request, User $user)
    {
        return $user->update($request->all());
    }

    public function deleteUser(User $user)
    {
        /** @var TYPE_NAME $user */
        return $user->delete($user);
    }
}
