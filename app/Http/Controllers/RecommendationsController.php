<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Services\Ai\AiMovieRecommendationsInterface;
use Illuminate\View\View;

class RecommendationsController extends Controller
{
    public function __construct(
        private readonly AiMovieRecommendationsInterface $aiMovieRecommendations
    ) {}

    public function index(): View
    {
        $genres = Genre::getAllGenresArray();

        $translatedGenres = [];
        foreach ($genres as $genre) {
            $translatedGenres[$genre] = __($genre);
        }

        $anyElement = ['Any' => __('messages.any_genre')];  // Define the new key-value pair
        $translatedGenres = array_merge($anyElement, $translatedGenres);

        return view('recommendations.index', [
            'genres' => $translatedGenres,
        ]);
    }

    public function getRecommendations(): string
    {
        $data = request()->all();

        try {
            $movies = $this->aiMovieRecommendations->getRecommendations($data);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }

        foreach ($movies as $movie) {
            $this->includeCredits($movie);
        }

        return $movies->toJson();
    }

    private function includeCredits(Movie $movie): void
    {
        $this->includeDirectors($movie);
        $this->includeScreenwriters($movie);
        $this->includeCasting($movie);
    }

    private function includeDirectors(Movie $movie): void
    {
        $directors = $movie->credits()
            ->withDepartment('Director')
            ->get();
        $directors = $directors->map(function ($director) {
                return $director->person->name;
            })->implode(', ');

        $movie->directors = $directors;
    }

    private function includeScreenwriters(Movie $movie): void
    {
        $screenwriters = $movie->credits()
            ->withDepartment('Screenplay')
            ->get();
        $screenwriters = $screenwriters
            ->map(function ($screenwriter) {
                return $screenwriter->person->name;
            })->implode(', ');

        $movie->screenwriters = $screenwriters;
    }

    private function includeCasting(Movie $movie): void
    {
        $casting = $movie->credits()
            ->withDepartment('Acting')
            ->with('Person')
            ->get()
            ->sortByDesc(function ($credit) {
                return $credit->person->popularity;
            })->take(4)
            ->map(function ($credit) {
                return $credit->person->name;
            })->implode(', ');

        $movie->casting = $casting;
    }
}
