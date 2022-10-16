<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }



    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }



    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|min:11',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }



    public function getUserById($id)
    {
        $user = User::find($id);
        return response()->json(['message' => 'Get User successfully By His ID', 'data' => $user]);
    }



    public function getAllUsers()
    {
        $users = User::all();
        return response()->json(['message' => 'Get All Users successfully', 'data' => $users]);
    }



    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return response()->json(['message' => 'User Updated successfully', 'data' => $user]);
    }



    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['message' => 'User Deleted successfully', 'data' => $user]);
    }


    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }



    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
