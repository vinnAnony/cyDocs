<?php
namespace App\Repositories;

use App\Contracts\UserRepositoryInterface;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function allUsers()
    {
        return User::with('department')
            ->with('role')->latest()
            ->get();
    }

    public function showUser($id)
    {
        return User::where('id', $id)->first();
    }

    public function createUser($nput)
    {
        return User::create($nput);
    }

    public function register($input)
    {
        $user = User::create($input);

        $userData = User::latest()->with('role')->with('department')->first();

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

            $user = User::where('email',$request->email)->with(['department','role'])->first();

            $token = auth()->user()->createToken('CyDocsToken')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'Successful login',
                'user' => $user,
                'token' => $token,
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ],200);
        }
    }

    public function updateUser(Request $request, User $user)
    {
        return $user->update($request->all());
    }

    public function deleteUser($userId)
    {
        $user=User::where('id',$userId)->delete();
        return ($user);
    }

    public function allUserRoles()
    {
        return Role::all();
    }

    public function createUserRole(RoleRequest $request)
    {
        return Role::create($request->all());
    }
}
