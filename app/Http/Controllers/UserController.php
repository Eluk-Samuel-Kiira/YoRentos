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
        $roles = Role::whereNot('name', 'Admin')->get();
        return view('users.index', compact('permissions','roles'));
    }

    public function userRoles()
    {
        $roles = DB::table('roles')->whereNot('name', 'Admin')->get();
        return response()->json([
            'roles' => $roles,
        ]);
    }

    public function userDetails()
    {
        $users = User::latest()->get();
        $roles = Role::with('permissions')->get();
        
        return response()->json([
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    public function editRolePermission(Request $request)
    {
        $roleName = $request->role;
        $permissions = $request->permissions;

        // Create a new role and permissions
        $userRole = Role::where('name', $roleName)->first();
        $userRole->syncPermissions($permissions);
        return redirect()->route('user')->with('success', 'Role edited successfully');
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

    public function changeRole(Request $request)
    {
        $roleName = $request->newRole;
        $user_id = $request->user;

        User::where('id', $user_id)->whereNot('role', 'Admin')->update(['role' => $roleName]);
        return redirect()->route('user')->with('success', 'Role changed successfully');
    }

    public function changeStatus($id)
    {
        $user = User::where('id', $id)->whereNotIn('role', ['Admin'])->first();

        if ($user) {
            if ($user->status == 1) {
                $user->where('id', $id)->update(['status' => 0]);
            } else {
                $user->where('id', $id)->update(['status' => 1]);
            }
            
            return redirect()->route('user')->with('success', 'User Status Changed successfully');
        } else {
            return redirect()->route('user')->with('error', 'User Not found or an Admin');
        }
    }

    public function deleteRole($role_id)
    {
        $role = Role::where('id', $role_id)->whereNotIn('name', ['Admin','Landlord','Broker','Tenant'])->first();
        if ($role) {
            $role->delete();
            
            return redirect()->route('user')->with('success', 'Role DELETED successfully');
        } else {
            return redirect()->route('user')->with('error', 'Role Not found or an undeletable');
        }
    }
}
