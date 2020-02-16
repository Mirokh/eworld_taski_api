<?php

namespace App\Http\Controllers;

use App\Eloquent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $response['token'] = $user->createToken('MyApp')->accessToken;
            $response['user'] = $user;
            return response()->json($response, $this->successStatus);
        } else {
            return response()->json(['error' => 'Credentials not valid'], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3|max:12',
            'last_name' => 'required|min:3|max:12',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::query()->create($input);
        $response['token'] = $user->createToken('MyApp')->accessToken;
        $response['user'] = $user;
        return response()->json($response, $this->successStatus);
    }

    public function auth()
    {
        return response()->json(request()->user());
    }

    public function logout()
    {
        response()->json(request()->user()->token()->revoke());
    }

}
