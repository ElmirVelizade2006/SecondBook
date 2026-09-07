<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\PasswordOtp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class AuthController extends \App\Http\Controllers\Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'username'   => 'required|string|max:255|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
            'terms'      => 'accepted',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'username.required'   => 'Username is required.',
            'username.unique'     => 'This username is already taken.',
            'email.required'      => 'Email address is required.',
            'email.email'         => 'Please enter a valid email address.',
            'email.unique'        => 'This email is already registered.',
            'password.required'   => 'Password is required.',
            'password.min'        => 'Password must be at least 8 characters.',
            'password.confirmed'  => 'Password confirmation does not match.',
            'terms.accepted'      => 'You must accept the Terms and Conditions.',
        ]);

        $user = User::create([
            'name'       => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('frontend.home');
    }

    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {

        $credentials = $request->validate(
        [
            'email' => 'required|email',

            'password' => 'required',
        ],
        [
            'email.required' => 'Email address is required.',

            'email.email' => 'Please enter a valid email address.',

            'password.required' => 'Password is required.',
        ]);



        $remember = $request->boolean('remember');

        $email = trim(strtolower($credentials['email']));
        $password = $credentials['password'];

        $user = User::whereRaw('LOWER(email) = ?', [$email])->first();

        if ($user) {
            $passwordValid = false;

            if (Hash::check($password, $user->password)) {
                $passwordValid = true;
            } elseif ($user->password && $password === $user->password) {
                $passwordValid = true;
                $user->password = Hash::make($password);
                $user->save();
            }

            if ($passwordValid) {
                Auth::login($user, $remember);
                $request->session()->regenerate();

                $role = strtolower((string) ($user->role ?? ''));

                if (in_array($role, ['admin', 'superadmin', 'administrator'], true)) {
                    return redirect()->route('admin.dashboard');
                }

                return redirect()->route('frontend.home');
            }
        }

        return back()
            ->with('error', 'Invalid email or password.');

    }

    /*
    |--------------------------------------------------------------------------
    | Password Request
    |--------------------------------------------------------------------------
    */

    public function passwordRequest()
    {
        return view('auth.password-request');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);


        $otp = rand(100000, 999999);



        PasswordOtp::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'otp_code' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10)
            ]
        );



        try {
            Mail::raw("Your SecondBook password reset code is: $otp", function ($message) use ($request) {

                $message->to($request->email)
                        ->subject('SecondBook Password Reset OTP');

            });
        } catch (\Throwable $e) {
            report($e);
        }



        // Emaili session-da saxlayırıq
        session([
            'reset_email' => $request->email
        ]);



        return redirect()
            ->route('frontend.auth.password.verify')
            ->with('status', 'Please enter the verification code sent to your email.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|digits:6',
            'password' => 'required|min:8',
        ]);



        $otp = PasswordOtp::where('email', session('reset_email'))
            ->where('otp_code', $request->otp_code)
            ->first();



        if (!$otp) {

            return back()->withErrors([
                'otp_code' => 'Invalid OTP code.'
            ]);

        }



        if (Carbon::now()->greaterThan($otp->expires_at)) {

            return back()->withErrors([
                'otp_code' => 'OTP code has expired.'
            ]);

        }




        $user = User::where('email', $otp->email)->first();



        if (!$user) {

            return back()->withErrors([
                'email' => 'User not found.'
            ]);

        }




        $user->update([
            'password' => Hash::make($request->password)
        ]);




        // OTP silinir
        $otp->delete();



        // Session təmizlənir
        session()->forget('reset_email');



        return redirect()
            ->route('frontend.auth.login')
            ->with('status', 'Password reset successfully.');

    }

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {

        Auth::logout();


        $request->session()->invalidate();


        $request->session()->regenerateToken();



        return redirect()
            ->route('frontend.auth.login');

    }

    /*
    |--------------------------------------------------------------------------
    | My Profile
    |--------------------------------------------------------------------------
    */

    public function myprofile()
    {
        $user = Auth::user();
        return view('Auth.my-profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('Auth.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validateWithBag('profileUpdate', [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'username' => ['nullable', 'string', 'max:100', Rule::unique('users', 'username')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', Rule::in(['male', 'female', 'prefer_not_to_say'])],
            'country' => ['nullable', 'string', 'max:120'],
            'city' => ['nullable', 'string', 'max:120'],
            'state' => ['nullable', 'string', 'max:120'],
            'postal_code' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:300'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'receive_email_notifications' => ['nullable', 'boolean'],
            'receive_order_updates' => ['nullable', 'boolean'],
            'receive_promotional_emails' => ['nullable', 'boolean'],
            'profile_visibility' => ['nullable', 'boolean'],
        ]);

        $profilePhotoPath = $user->profile_photo ?? null;

        if ($request->hasFile('profile_photo')) {
            if ($profilePhotoPath) {
                Storage::disk('public')->delete($profilePhotoPath);
            }

            $profilePhotoPath = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $firstName = trim((string) $validated['first_name']);
        $lastName = trim((string) $validated['last_name']);
        $fullName = trim($firstName . ' ' . $lastName);

        $user->update([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'name' => $fullName,
            'username' => $validated['username'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'country' => $validated['country'] ?? null,
            'city' => $validated['city'] ?? null,
            'state' => $validated['state'] ?? null,
            'postal_code' => $validated['postal_code'] ?? null,
            'address' => $validated['address'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'profile_photo' => $profilePhotoPath,
            'receive_email_notifications' => $request->boolean('receive_email_notifications'),
            'receive_order_updates' => $request->boolean('receive_order_updates'),
            'receive_promotional_emails' => $request->boolean('receive_promotional_emails'),
            'profile_visibility' => $request->boolean('profile_visibility', true),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
    }

    public function removeProfilePhoto()
    {
        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
            $user->update(['profile_photo' => null]);
        }

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile photo removed successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validateWithBag('passwordUpdate', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Password updated successfully.');
    }

    public function destroyProfile(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontend.home')->with('success', 'Your account has been deleted.');
    }

}