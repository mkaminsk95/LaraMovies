<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\MovieRecommendationResource;
use App\Models\Genre;
use App\Models\Movie;
use App\Services\Ai\AiMovieRecommendationsInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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

    public function getRecommendations(): AnonymousResourceCollection|string
    {
        $data = request()->all();

        try {
            $movies = $this->aiMovieRecommendations->getRecommendations($data);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]) ?: '';
        }

        return MovieRecommendationResource::collection($movies);
    }


}
