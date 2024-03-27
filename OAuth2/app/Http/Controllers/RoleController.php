<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->get();

        if (is_null($roles->first())) {
            return response()->json([
                'status' => 'failed',
                'message' => 'No role found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Roles are retrieved successfully.',
            'data' => $roles,
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'role' => 'required|string|max:250|unique:roles,role'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $role = Role::create($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Role is added successfully.',
            'data' => $role,
        ];

        return response()->json($response, 200);
    }

    public function show($id)
    {
        $role = Role::find($id);

        if (is_null($role)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Role is not found!',
            ], 200);
        }

        $response = [
            'status' => 'success',
            'message' => 'Role is retrieved successfully.',
            'data' => $role,
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'role' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);
        }

        $role = Role::find($id);

        if (is_null($role)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Role is not found!',
            ], 200);
        }

        $role->update($request->all());

        $response = [
            'status' => 'success',
            'message' => 'Role is updated successfully.',
            'data' => $role,
        ];

        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (is_null($role)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Role is not found!',
            ], 200);
        }

        Role::destroy($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Role is deleted successfully.'
        ], 200);
    }
}
