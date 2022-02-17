<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

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
        $userData = User::latest()->first();

        $token = $user->createToken('CyDocsToken')->accessToken;
        return response()->json([
            'success' => true,
            'message' => 'Successful sign up',
            'user' => $userData,
            'token' => $token,
        ],200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('CyDocsToken')->accessToken;
            return response()->json([
                'success' => true,
                'message' => 'Successful login',
                'user' => auth()->user(),
                'token' => $token,
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ],200);
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
