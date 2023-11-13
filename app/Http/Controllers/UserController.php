<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use HasRoles;

    public function userLocation(Request $request)
    {
        $user_id = $request->input('user_id');
        $user_latitude = $request->input('user_latitude');
        $user_longitude = $request->input('user_longitude');

        User::updateOrInsert(['id' => $user_id],[
            'latitude' => $user_latitude, 'longitude'=> $user_longitude
        ]);

        return response()->json([
            'message' => 'User Location Captured Successfully'
        ]);
    }

    public function userIndex()
    {
        $permissions = Permission::whereNot('name', 'manage all')->get();
        return view('users.index', compact('permissions'));
    }

    public function userDetails()
    {
        $users = User::where('status', 1)->latest()->get();
        return response()->json(['users' => $users]);
    }

    public function userPermissions()
    {
        //
    }

    public function createColesAndPermissions(Request $request)
    {
        try {
            $roleName = $request->role;
            $permissions = $request->permissions;
    
            // Create a new role and permissions
            $userRole = Role::create(['name' => $roleName, 'guard_name' => 'web']);
            $userRole->syncPermissions($permissions);
    
            return redirect()->route('user')->with('success', 'Role created successfully');
        } catch (QueryException $e) {
            // Handle database-related exceptions (e.g., unique constraint violation)
            return redirect()->back()->with('error', 'Error creating role: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

    }
}
