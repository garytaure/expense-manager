<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

use App\UserRoles;
use App\User;
use App\Http\Resources\UserRoles as UserRoleResource;
use App\Http\Resources\UserRolesCollection;

class UserRoleController extends Controller
{
    public function index()
    {
        if (!Auth::user()->allowed('role_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new UserRolesCollection(UserRoles::all());
    }

    public function show($id)
    {
        if (!Auth::user()->allowed('role_read')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        return new UserRoleResource(UserRoles::findOrFail($id));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->allowed('role_create')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $request->merge([
            'role_create'   => (bool) json_decode($request->get('role_create')),
            'role_read'     => (bool) json_decode($request->get('role_read')),
            'role_update'   => (bool) json_decode($request->get('role_update')),
            'role_delete'   => (bool) json_decode($request->get('role_delete')),
            'user_create'   => (bool) json_decode($request->get('user_create')),
            'user_read'     => (bool) json_decode($request->get('user_read')),
            'user_update'   => (bool) json_decode($request->get('user_update')),
            'user_delete'   => (bool) json_decode($request->get('user_delete')),
            'expense_category_create'   => (bool) json_decode($request->get('expense_category_create')),
            'expense_category_read'     => (bool) json_decode($request->get('expense_category_read')),
            'expense_category_update'   => (bool) json_decode($request->get('expense_category_update')),
            'expense_category_delete'   => (bool) json_decode($request->get('expense_category_delete')),
            'expense_create'    => (bool) json_decode($request->get('expense_create')),
            'expense_read'      => (bool) json_decode($request->get('expense_read')),
            'expense_update'    => (bool) json_decode($request->get('expense_update')),
            'expense_delete'    => (bool) json_decode($request->get('expense_delete'))
        ]);

        $request->validate([
            'name' => 'required|max:255',
            'role_create' => 'required|boolean',
            'role_read' => 'required|boolean',
            'role_update' => 'required|boolean',
            'role_delete' => 'required|boolean',
            'user_create' => 'required|boolean',
            'user_read' => 'required|boolean',
            'user_update' => 'required|boolean',
            'user_delete' => 'required|boolean',
            'expense_category_create' => 'required|boolean',
            'expense_category_read' => 'required|boolean',
            'expense_category_update' => 'required|boolean',
            'expense_category_delete' => 'required|boolean',
            'expense_create' => 'required|boolean',
            'expense_read' => 'required|boolean',
            'expense_update' => 'required|boolean',
            'expense_delete' => 'required|boolean',
        ]);
        $userRole = UserRoles::create($request->all());

        return (new UserRoleResource($userRole))
            ->response()
            ->setStatusCode(200);
    }

    public function update(Request $request)
    {
        if (!Auth::user()->allowed('role_update')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $userRole = UserRoles::findOrFail($request->id);
        if (Str::lower($userRole->name) === 'administrator') {
            return response()->json(['message' => 'You are not allowed to update the Administrator role.'], 403);
        }
        $request->merge([
            'role_create'   => (bool) json_decode($request->get('role_create')),
            'role_read'     => (bool) json_decode($request->get('role_read')),
            'role_update'   => (bool) json_decode($request->get('role_update')),
            'role_delete'   => (bool) json_decode($request->get('role_delete')),
            'user_create'   => (bool) json_decode($request->get('user_create')),
            'user_read'     => (bool) json_decode($request->get('user_read')),
            'user_update'   => (bool) json_decode($request->get('user_update')),
            'user_delete'   => (bool) json_decode($request->get('user_delete')),
            'expense_category_create'   => (bool) json_decode($request->get('expense_category_create')),
            'expense_category_read'     => (bool) json_decode($request->get('expense_category_read')),
            'expense_category_update'   => (bool) json_decode($request->get('expense_category_update')),
            'expense_category_delete'   => (bool) json_decode($request->get('expense_category_delete')),
            'expense_create'    => (bool) json_decode($request->get('expense_create')),
            'expense_read'      => (bool) json_decode($request->get('expense_read')),
            'expense_update'    => (bool) json_decode($request->get('expense_update')),
            'expense_delete'    => (bool) json_decode($request->get('expense_delete'))
        ]);

        $newData = $request->validate([
            'name' => 'required|max:255',
            'role_create' => 'required|boolean',
            'role_read' => 'required|boolean',
            'role_update' => 'required|boolean',
            'role_delete' => 'required|boolean',
            'user_create' => 'required|boolean',
            'user_read' => 'required|boolean',
            'user_update' => 'required|boolean',
            'user_delete' => 'required|boolean',
            'expense_category_create' => 'required|boolean',
            'expense_category_read' => 'required|boolean',
            'expense_category_update' => 'required|boolean',
            'expense_category_delete' => 'required|boolean',
            'expense_create' => 'required|boolean',
            'expense_read' => 'required|boolean',
            'expense_update' => 'required|boolean',
            'expense_delete' => 'required|boolean',
        ]);
        UserRoles::where('id', $userRole->id)->update($newData);
        $userRole = UserRoles::findOrFail($userRole->id);

        return (new UserRoleResource($userRole))
            ->response()
            ->setStatusCode(200);
    }

    public function delete($id)
    {
        if (!Auth::user()->allowed('role_delete')) {
            return response()->json(['message' => 'You have no permission to perform this task.'], 403);
        }
        $role = UserRoles::findOrFail($id);
        if (Str::lower($role->name) === 'administrator') {
            return response()->json(['message' => 'You are not allowed to delete the Administrator role.'], 403);
        }
        if (User::where('role_id', $id)->exists()) {
            return response()->json(['message' => 'Could not delete this role, it is currently assigned to users.'], 403);
        }
        $role->delete();

        return response()->json(['message' => 'User Role deleted.'], 200);
    }
}