<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Favourite;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\WatchlistItem;
use App\Services\MovieListService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index(MovieListService $movieListService): View
    {
        $query = (array) (request()->query() ?? []);
        $sorting = $query['sorting'] ?? 'vote_average.desc';

        $movies = $movieListService->getPaginatedList($query, $sorting, 20);

        $genresList = Genre::getAllGenresArray();

        return view('movies.index', [
            'paginatedMovies' => $movies,
            'genres' => $genresList,
            'query' => $query,
        ]);
    }

    public function create(): View
    {
        return view('movies.create');
    }

    public function store(StoreMovieRequest $request): RedirectResponse
    {
        $movie = Movie::create([
            'title' => request('title'),
            'original_title' => request('original-title'),
            'overview' => request('overview'),
            'release_date' => request('release-date'),
            'poster_path' => request('poster-path'),
            'backdrop_path' => request('backdrop-path'),
            'original_language' => request('original-language'),
        ]);

        return redirect()->route('movies.show', ['id' => $movie->id]);
    }

    public function show(int $id): View
    {
        $movie = Movie::findOrFail($id);
        if (Auth::check()) {
            $user = auth()->user();
            $isFavourite = $user->favourites()->where('movie_id', $movie->id)->exists();
            $isWatchlistItem = $user->watchlistItems()->where('movie_id', $movie->id)->exists();
            $rating = $movie->ratings()->where('user_id', $user->id)->first()?->rating;
            $review = $movie->reviews()->where('user_id', $user->id)->first();
        }

        $movieBudget = $movie['budget'] ? number_format($movie['budget'], thousands_separator: '.').' $' : '-';
        $movieRevenue = $movie['revenue'] ? number_format($movie['revenue'], thousands_separator: '.').' $' : '-';

        $runtimeFormatted = $movie['runtime'] ?
            floor($movie['runtime'] / 60).'h '.($movie['runtime'] % 60).'m' : '-';

        $directors = $movie->credits()->withDepartment('Director')->get();
        $directors = $directors->map(function ($director) {
            return $director->person->name;
        })->implode(', ');

        $screenwriters = $movie->credits()->withDepartment('Screenplay')->get();
        $screenwriters = $screenwriters->map(function ($screenwriter) {
            return $screenwriter->person->name;
        })->implode(', ');

        $cast = $movie->credits()->withDepartment('Acting')->with('person')->get();

        return view(
            'movies.show',
            [
                'movie' => $movie,
                'rating' => $rating ?? null,
                'review' => $review ?? null,
                'isFavourite' => $isFavourite ?? false,
                'isWatchlistItem' => $isWatchlistItem ?? false,
                'runtimeFormatted' => $runtimeFormatted,
                'directors' => $directors,
                'screenwriters' => $screenwriters,
                'movieBudget' => $movieBudget,
                'movieRevenue' => $movieRevenue,
                'cast' => $cast,
            ]
        );
    }

    public function edit(int $id): View
    {
        $movie = Movie::find($id);

        return view('movies.edit', ['movie' => $movie]);
    }

    public function update(StoreMovieRequest $request, int $id): RedirectResponse
    {
        $movie = Movie::findOrFail($id);
        $movie->update([
            'title' => request('title'),
            'original_title' => request('original-title'),
            'overview' => request('overview'),
            'release_date' => request('release-date'),
            'poster_path' => request('poster-path'),
            'backdrop_path' => request('backdrop-path'),
            'original_language' => request('original-language'),
        ]);

        return redirect()->route('movies.edit', ['id' => $movie->id])->with('success', __('Movie successfully updated!'));
    }

    public function destroy(int $id): RedirectResponse
    {
        Movie::findOrFail($id)->delete();

        return redirect()->route('movies.index')->with('success', __('Movie successfully deleted!'));
    }

    public function rate(int $movieId): JsonResponse
    {
        $rating = request()->query('rating');
        $user = auth()->user();

        Rating::updateOrCreate(['user_id' => $user->id, 'movie_id' => $movieId], ['rating' => $rating]);

        return response()->json(['success' => true]);
    }

    public function deleteRating(int $movieId): JsonResponse
    {
        $user = auth()->user();

        Rating::where([
            ['user_id', $user->id],
            ['movie_id', $movieId],
        ])->firstOrFail()->delete();

        return response()->json(['success' => true]);
    }

    public function addToFavourites(int $movieId): JsonResponse
    {
        $user = auth()->user();

        Favourite::create(['user_id' => $user->id, 'movie_id' => $movieId]);

        return response()->json(['success' => true]);
    }

    public function addToWatchlist(int $movieId): JsonResponse
    {
        $user = auth()->user();

        WatchlistItem::create(['user_id' => $user->id, 'movie_id' => $movieId]);

        return response()->json(['success' => true]);
    }

    public function review(int $movieId): RedirectResponse
    {
        // validate if the name and description are not empty and if description is not too long (max 255 characters)
        request()->validate([
            'name' => 'required',
            'description' => 'required|max:255',
        ]);

        $movie = Movie::findOrFail($movieId);
        $user = auth()->user();
        $name = request('name');
        $description = request('description');

        // Check if the user has already reviewed the movie and if not create a new review
        $review = $movie->reviews()->where('user_id', $user->id)->first();
        if ($review) {
            $review->update(['name' => $name, 'description' => $description]);
        } else {
            $movie->reviews()->create(['user_id' => $user->id, 'name' => $name, 'description' => $description]);
        }

        return redirect()->route('movies.show', ['id' => $movie->id]);
    }
}
