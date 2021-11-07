<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Resources\Users as UserResource;
use App\Http\Resources\UsersCollection;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $token = Str::random(60);
        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::id());
            $user->api_token = hash('sha256', $token);
            $user->save();
            $user->show_api_token = true;
            return (new UserResource($user))
                ->response()
                ->setStatusCode(200);
        }

        return response()->json(["message" => "Invalid login credentials."], 401);
    }

    public function index()
    {
        if (!Auth::user()->allowed('user_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new UsersCollection(User::all());
    }

    public function show($id)
    {
        if (!Auth::user()->allowed('user_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new UserResource(User::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->allowed('user_create')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $request->validate([
            'role_id' => 'required|integer',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $token = Str::random(60);
        $request->merge([
            'password' =>  Hash::make($request->get('password')),
            'api_token' => hash('sha256', $token)
        ]);
        $user = User::create($request->all());

        return (new UserResource($user))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request)
    {
        if (!Auth::user()->allowed('user_update')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $user = User::findOrFail($request->id);
        $request->validate([
            'role_id' => 'required|integer',
            'name' => 'required|max:255',
        ]);
        if ((Str::length($request->get('password'))) && (Str::length($request->get('confirm_password')))) {
            if ($request->get('password') == $request->get('confirm_password')) {
                $request->merge([
                    'password' =>  Hash::make($request->get('password')),
                ]);
                $user->password = $request->password;
            } else {
                return response()->json(['message' => 'Password and Confirm Password did not matched.'], 200);
            }
        }
        $user->role_id = $request->role_id;
        $user->name = $request->name;

        return (new UserResource($user));
    }

    public function delete($id)
    {
        if (!Auth::user()->allowed('user_delete')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted.'], 200);
    }
}