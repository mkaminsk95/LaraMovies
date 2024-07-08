<?php

namespace App\Http\Controllers;

use App\Models\WatchlistItem;
use Illuminate\Support\Facades\Auth;

class WatchlistItemController extends Controller
{
    public function store(int $movieId): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            $user = auth()->user();

            WatchlistItem::create(['user_id' => $user->id, 'movie_id' => $movieId]);

            return response()->json(['success' => true]);
        } else {
            return redirect(route('login'));
        }
    }

    public function destroy(int $id): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (Auth::check()) {
            $user = auth()->user();

            WatchlistItem::where('user_id', $user->id)->where('movie_id', $id)->delete();

            return response()->json(['success' => true]);
        } else {
            return redirect(route('login'));
        }
    }
}
