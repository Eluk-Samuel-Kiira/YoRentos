<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
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
        $users = User::where('status', 1)->get();
        return response()->json(['users' => $users]);
    }

    public function rolesAndPermissions(Request $request)
    {

    }
}
