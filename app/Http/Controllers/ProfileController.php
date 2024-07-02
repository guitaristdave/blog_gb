<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $request->user()->fill(
                $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
                ])
            );

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();
        } catch (ValidationException $e) {
            return redirect()->route('profile.edit')->withErrors($e->errors())->withInput();
        }

        return redirect()->route('profile.edit')->with('message', 'Profile updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } catch (ValidationException $e) {
            return redirect()->route('profile.edit')->withErrors($e->errors())->withInput();
        }

        return redirect()->to('/');
    }

    public function manageUsers(Request $request): View
    {
        return view('profile.manage', [
            'selectedUser' => $request->id ? User::findOrFail($request->id) : '',
            'user' => $request->user(),
            'users' => $request->user()->is_admin ? User::all()->where('id', '!=', $request->user()->id) : [],
        ]);
    }

    public function updateUser(ProfileUpdateRequest $request)
    {
        try {
            if ($request->user()->is_admin && $request->id) {
                $user = User::findOrFail($request->id);
                $user->fill(
                    $request->validate([
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
                    ])
                );
                $user->update($request->all());
            }
        } catch (ValidationException $e) {
            return redirect()->route('profile.manage-users', ['id'=>$request->id])->withErrors($e->errors())->withInput();
        }

        return redirect()->route('profile.manage-users', ['id'=>$request->id])->with('status', 'user-profile-updated');
    }

    public function destroyUser(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            if ($request->user()->is_admin && $request->id) {
                $user = User::findOrFail($request->id);
                $user->delete();
            }
        } catch (ValidationException $e) {
            return redirect()->route('profile.manage-users', ['id'=>$request->id])->withErrors($e->errors())->withInput();
        }

        return Redirect::route('profile.manage-users');
    }
}
