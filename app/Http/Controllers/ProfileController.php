<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($request->user()->id)],
        ]));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function posts(Request $request): View
    {
        return view('profile.posts', [
            'user' => $request->user(),
            'posts' => DB::table('posts')
                ->where('user_id', '=', $request->user()->id)
                ->paginate(4),
        ]);
    }

    public function manageUsers(Request $request): View
    {

        return view('profile.manage-users', [
            'selectedUser' => $request->id ? User::findOrFail($request->id) : '',
            'user' => $request->user(),
            'users' => $request->user()->is_admin ? User::all()->where('id', '!=', $request->user()->id) : [],
        ]);
    }

    public function updateUser(ProfileUpdateRequest $request)
    {
        if ($request->user()->is_admin && $request->id){
            $user = User::findOrFail($request->id);
            $user->fill($request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            ]));
            $user->update($request->all());
        }
        return Redirect::route('profile.manage-users', ['id'=>$request->id])->with('status', 'user-profile-updated');
    }

    public function destroyUser(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        if ($request->user()->is_admin && $request->id) {
            $user = User::findOrFail($request->id);
            $user->delete();
        }

        return Redirect::route('profile.manage-users');
    }
}
