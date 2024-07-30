<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Avatar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function show(Request $request): View
    {
        $favourites = $request->user()->favourites()->get();
        $watchlist = $request->user()->watchlistItems()->get();
        $recentRatings = $request->user()->ratings()->orderByDesc('created_at')->get();
        $topRatings = $request->user()->ratings()->orderByDesc('rating')->get();
        $topRated = $request->user()->ratings()->orderByDesc('rating')->first()?->movie;
        $avatars = Avatar::all();

        if ($request->headers->get('referer')) {
            $request->session()->reflash();
            $request->session()->forget('status');
        }

        return view('profile.show', [
            'user' => $request->user(),
            'favourites' => $favourites,
            'watchlist' => $watchlist,
            'recentRatings' => $recentRatings,
            'topRatings' => $topRatings,
            'topRated' => $topRated,
            'avatars' => $avatars,
        ]);
    }

    public function updateAvatar(Request $request): JsonResponse
    {
        try {
            $avatarId = $request->input('avatarId');

            $request->validate([
                'avatarId' => ['required', 'exists:avatars,id'],
            ]);

            $user = $request->user();
            $user->avatar_id = $avatarId;
            $request->user()->save();

            return response()->json([
                'status' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update avatar. Please try again.'
            ]);
        }
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

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
}
