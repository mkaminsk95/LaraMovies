<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\MovieRecommendationResource;
use App\Models\Genre;
use App\Services\Ai\AiMovieRecommendationsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RecommendationsController extends Controller
{
    public function __construct(
        private readonly AiMovieRecommendationsInterface $aiMovieRecommendations
    ) {
    }

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

    public function getRecommendations(): JsonResponse
    {
        $data = request()->all();

        try {
            $movies = $this->aiMovieRecommendations->getRecommendations($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json(MovieRecommendationResource::collection($movies), Response::HTTP_OK);
    }
}
