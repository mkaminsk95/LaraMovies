<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Models\Favourite;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\WatchlistItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = request()->query();
        $moviesQuery = $this->applyFilters(Movie::query(), $query);

        $movies = $moviesQuery->orderBy('vote_average', 'desc')->paginate(20);
        $genresList = Genre::getAllGenresArray();

        return view('movies.index', [
            'paginatedMovies' => $movies,
            'genres' => $genresList,
            'query' => $query,
        ]);
    }

    private function applyFilters($query, $filters)
    {
        foreach ($filters as $key => $value) {
            if (!is_null($value) && method_exists($this, $method = 'filter' . ucfirst(Str::camel($key)))) {
                $this->$method($query, $value);
            }
        }
        return $query;
    }

    private function filterGenre($query, $genres)
    {
        return $query->withGenre($genres);
    }

    private function filterTitle($query, $title)
    {
        return $query->withTitle($title);
    }

    private function filterYear($query, $year)
    {
        return $query->withYear($year);
    }

    private function filterVoteAverage($query, $voteAverage)
    {
        return $query->withVoteAverage($voteAverage);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovieRequest $request)
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

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $movie = Movie::findOrFail($id);

        if (Auth::check()) {
            $user = auth()->user();
            $isFavourite = $user->favourites()->where('movie_id', $movie->id)->exists();
            $isWatchlistItem = $user->watchlistItems()->where('movie_id', $movie->id)->exists();
            $rating = $movie->ratings()->where('user_id', $user->id)->first()?->rating;
        }

        return view(
            'movies.show',
            [
                'movie' => $movie,
                'rating' => $rating ?? null,
                'isFavourite' => $isFavourite ?? false,
                'isWatchlistItem' => $isWatchlistItem ?? false
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $movie = Movie::find($id);

        return view('movies.edit', ['movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMovieRequest $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'original-title' => 'required',
            'overview' => 'required',
            'release-date' => ['required', 'date'],
            'original-language' => ['required', Rule::in(array_values(config('movie_languages')))],
        ]);

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

        return redirect()->route('movies.edit', ['id' => $movie->id])->with('success', 'Movie successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        Movie::findOrFail($id)->delete();

        return redirect()->route('movies.index')->with('success', 'Movie successfully deleted!');
    }

    public function rate(int $movieId)
    {
        $rating = request()->query('rating');
        $user = auth()->user();

        Rating::updateOrCreate(['user_id' => $user->id, 'movie_id' => $movieId], ['rating' => $rating]);

        return response()->json(['success' => true]);
    }

    public function deleteRating(int $movieId)
    {
        $user = auth()->user();

        Rating::where([
            ['user_id', $user->id],
            ['movie_id', $movieId]
        ])->firstOrFail()->delete();

        return response()->json(['success' => true]);
    }

    public function addToFavourites(int $movieId): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();

        Favourite::create(['user_id' => $user->id, 'movie_id' => $movieId]);

        return response()->json(['success' => true]);
    }

    public function addToWatchlist(int $movieId): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = auth()->user();

        WatchlistItem::create(['user_id' => $user->id, 'movie_id' => $movieId]);

        return response()->json(['success' => true]);
    }
}
