<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\District;
use App\Models\Broker;
use App\Models\OTPGen;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ConfirmOTP;

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
        return view('users.index');
    }

    public function rolePermissions()
    {
        $permissions = Permission::all();
        $roles = Role::with('permissions')->get();
        return view('users.role-permissions', compact(
            'permissions',
            'roles',
        ))->render();
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

        if (empty($roleName) || empty($permissions)) {
            return response()->json(['success' => false, 'message' => 'Role name or permissions are empty']);
        }

        $userRole = Role::where('name', $roleName)->whereNot('name','Admin')->first();
        if ($userRole) {
            $userRole->syncPermissions($permissions);
            return response()->json(['success' => true, 'message' => 'User Role Updated Successfully']);
        }else {
            return response()->json(['success' => false, 'message' => 'An error occurred']);
        }
    }

    public function createRolesAndPermissions(Request $request)
    {
        try {
            $roleName = $request->role;
            $permissions = $request->permissions;
    
            // Create a new role and permissions
            $userRole = Role::create(['name' => $roleName, 'guard_name' => 'web']);
            $userRole->syncPermissions($permissions);
    
            return response()->json(['success' => true, 'message' => 'Role Created Successfully']);
        } catch (QueryException $e) {
            // Handle database-related exceptions (e.g., unique constraint violation)
            return response()->json(['success' => false, 'message' => 'An error occurred ' . $e->getMessage()]); 
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred ' . $e->getMessage()]); 
        }

    }

    public function changeRole(Request $request)
    {
        $roleName = $request->role;
        $user_id = $request->user_id;

        $user_role = User::where('id', $user_id)->whereNot('role', 'Admin')->update(['role' => $roleName]);
        if (!$user_role) {
            return response()->json(['success' => false, 'message' => 'Admin Role Cannot Change']); 
        }
        $user = User::where('id', $user_id)->first();
        $userRole = Role::where('name', $roleName)->first(); 

        if ($userRole) {
            $user->syncRoles([$userRole]); 
            return response()->json(['success' => true, 'message' => 'User Role Updated Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'An error occurred']);        
        }
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
            return redirect()->back()->with('success', 'Role DELETED successfully');
        } else {
            return redirect()->back()->with('error', 'Role Not found or an undeletable');
        }
    }

    public function createBroker(Request $request)
    {
        $broker = new Broker();
        $broker->district_id = $request->district_id;
        $broker->broker_id = $request->broker_id;
        $broker->save();
        return redirect()->route('user')->with('success', 'Broker created successfully');
    }

    public function changeBrokerStatus($broker)
    {
        $this_broker = Broker::where('id', $broker)->first();

        if ($this_broker) {
            if ($this_broker->status == 1) {
                $this_broker->where('id', $broker)->update(['status' => 0]);
                return redirect()->route('user')->with('success', 'Broker Deactivated successfully');
            } else {
                $this_broker->where('id', $broker)->update(['status' => 1]);
                return redirect()->route('user')->with('success', 'Broker Activated successfully');
            }
        } else {
            return redirect()->route('user')->with('error', 'Broker Not found');
        }
    }

    public function deleteBroker($broker)
    {
        $this_broker = Broker::where('id', $broker)->first();
        if ($this_broker) {
            $this_broker->delete();
            return redirect()->route('user')->with('success', 'Broker Deleted successfully');
        } else {
            return redirect()->route('user')->with('error', 'Broker Not found');
        }
    }

    public function userAccount()
    {
        return view('auth.confirm-account');
    }

    public function otpRequest()
    {
        // Generate OTP
        $length = 6;
        $characters = '0123456789'; 
        $user = User::where('id', auth()->user()->id)->first();

        $otp_number = implode('', array_map(function() use ($characters) {
            return $characters[random_int(0, strlen($characters) - 1)];
        }, range(1, $length)));

        $otp_body = [
            'body' => 'OTP Alert',
            'message' => 'Enter this OTP before it expires '.$otp_number.'.',
            'url' => url('/dashboard'),
            'thankyou' => 'YoRentos. Thank You'
        ];

        OTPGen::updateOrCreate(
            ['user_id' => $user->id], 
            ['otp_number' => $otp_number] 
        );

        Notification::sendNow($user, new ConfirmOTP($otp_body));
    }

    public function otpConfirm(Request $request)
    {
        $user_otp = OTPGen::where('otp_number', $request->otp_number)
                  ->where('user_id', $request->user_id)
                  ->first();

        if ($user_otp) {
            $user = User::where('id', $request->user_id)->first();

            if ($user) {
                $user->where('id', $request->user_id)->update(['deleted' => 1]);
                $user_otp->delete();
            } else {
                return redirect()->back()->with('error', 'User Not Found');
            }
        } else {
            return redirect()->back()->with('error', 'Incorrect OTP Provideed');
        }
        return redirect()->route('dashboard')->with('success', 'OTP Confirmed Successfully');
    }

    public function userDeactivated()
    {
        return view('auth.deactivated-user');
    }

    public function myProfile()
    {
        $user_profile = User::where('status', 1)->where('id', auth()->user()->id)->first();
        return view('tenant.profile', compact(
            'user_profile',
        ));
    }
}
