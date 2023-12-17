<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ConfirmOTP;
use App\Models\OTPGen;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'min:10'],
            'role' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        //create a slug
        $slug = Str::slug($input['name']);
        $user = User::create([
            'name' => $input['name'],
            'slug' => $slug,
            'phone_number' => $input['phone_number'],
            'role' => $input['role'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        
        $userRole = Role::where('name', $input['role'])->first(); 

        if ($userRole) {
            $user->syncRoles([$userRole]); 
        } else {
            //
        }

        // Generate OTP
        $length = 6;
        $characters = '0123456789'; 

        $latestUserId = User::max('id');
        $user = User::find($latestUserId);

        $otp_number = implode('', array_map(function() use ($characters) {
            return $characters[random_int(0, strlen($characters) - 1)];
        }, range(1, $length)));

        $otp_body = [
            'body' => 'OTP Alert',
            'message' => 'Enter this OTP before it expires '.$otp_number.'.',
            'url' => url('/'),
            'thankyou' => 'YoRentos. Thank You'
        ];

        OTPGen::updateOrCreate(
            ['user_id' => $user->id], 
            ['otp_number' => $otp_number] 
        );

        Notification::sendNow($user, new ConfirmOTP($otp_body));

        return $user;
    }

}
