<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Account Settings
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | Update Preferences
    |--------------------------------------------------------------------------
    |
    | Notifications və Privacy settings.
    |
    */

    public function updatePreferences(
        Request $request
    ): RedirectResponse|JsonResponse {
        $validator = Validator::make(
            $request->all(),
            [
                'email_notifications' => [
                    'nullable',
                    'boolean',
                ],

                'order_updates' => [
                    'nullable',
                    'boolean',
                ],

                'promotional_emails' => [
                    'nullable',
                    'boolean',
                ],

                'profile_visible' => [
                    'nullable',
                    'boolean',
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Validation Error
        |--------------------------------------------------------------------------
        */

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Please check the submitted settings.',
                        'errors' => $validator->errors(),
                    ],
                    422
                );
            }

            return back()
                ->withErrors($validator)
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | User Settings
        |--------------------------------------------------------------------------
        */

        $settings = UserSetting::firstOrCreate(
            ['user_id' => $user->id],
            [
                'email_notifications' => true,
                'order_updates' => true,
                'promotional_emails' => false,
                'profile_visible' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Update Settings
        |--------------------------------------------------------------------------
        */

        $settings->update([
            'email_notifications' => $request->boolean(
                'email_notifications'
            ),

            'order_updates' => $request->boolean(
                'order_updates'
            ),

            'promotional_emails' => $request->boolean(
                'promotional_emails'
            ),

            'profile_visible' => $request->boolean(
                'profile_visible'
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | AJAX Response
        |--------------------------------------------------------------------------
        */

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your account preferences have been updated.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Normal Form Response
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Your account preferences have been updated.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Password
    |--------------------------------------------------------------------------
    */

    public function updatePassword(
    Request $request
): RedirectResponse|JsonResponse {
    $validator = Validator::make(
        $request->all(),
        [
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'confirmed',
                'different:current_password',
                'min:8',
                'max:128',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
        ],
        [
            'current_password.required' =>
                'Current password is required.',

            'current_password.current_password' =>
                'The current password is incorrect.',

            'password.required' =>
                'New password is required.',

            'password.min' =>
                'Password must be at least 8 characters.',

            'password.max' =>
                'Password must not exceed 128 characters.',

            'password.confirmed' =>
                'Password confirmation does not match.',

            'password.different' =>
                'New password must be different from your current password.',

            'password.regex' =>
                'Password must contain at least one lowercase letter and one number.',
        ]
    );

    if ($validator->fails()) {
        if ($request->expectsJson()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors(),
                ],
                422
            );
        }

        return back()
            ->withErrors(
                $validator,
                'passwordUpdate'
            )
            ->withInput();
    }

    $user = Auth::user();

    $user->update([
        'password' => Hash::make(
            $request->password
        ),
    ]);

    if ($request->expectsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.',
        ]);
    }

    return back()->with(
        'success',
        'Password updated successfully.'
    );
}
}