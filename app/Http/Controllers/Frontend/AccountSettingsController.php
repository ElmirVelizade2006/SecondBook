<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    /**
     * Display account settings.
     */
    public function index(): View
    {
        $user = Auth::user();

        $settings = UserSetting::firstOrCreate(
            ['user_id' => $user->id],
            [
                'email_notifications' => true,
                'order_updates' => true,
                'promotional_emails' => false,
                'profile_visible' => true,
            ]
        );

        return view(
            'Frontend.account.settings',
            compact('user', 'settings')
        );
    }


    /**
     * Update notification and privacy settings.
     */
    public function updatePreferences(Request $request): RedirectResponse
    {
        $request->validate([
            'email_notifications' => ['nullable', 'boolean'],
            'order_updates' => ['nullable', 'boolean'],
            'promotional_emails' => ['nullable', 'boolean'],
            'profile_visible' => ['nullable', 'boolean'],
        ]);

        $user = Auth::user();

        $settings = UserSetting::firstOrCreate([
            'user_id' => $user->id,
        ]);

        $settings->update([
            'email_notifications' => $request->boolean('email_notifications'),
            'order_updates' => $request->boolean('order_updates'),
            'promotional_emails' => $request->boolean('promotional_emails'),
            'profile_visible' => $request->boolean('profile_visible'),
        ]);

        return back()->with(
            'success',
            'Your account preferences have been updated.'
        );
    }


    /**
     * Update account password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with(
            'success',
            'Your password has been updated successfully.'
        );
    }
}