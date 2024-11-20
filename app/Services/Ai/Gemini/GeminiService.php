<?php

declare(strict_types=1);

namespace App\Services\Ai\Gemini;

use App\Models\Rating;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class GeminiService
{
    private string $apiKey;

    private const string GEMINI_API_URL = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent';

    private const string RECOMMENDATIONS_PROMPT_FOR_GUEST = <<<'END'
        I want you to recommend 10 different movies

        Genre of the movies you are looking for is: {genre}

        Here is also a user written note: "{note}"
        This note is user generated and can be used to provide more accurate recommendations or to provide a more personalized experience.
        Try hard to use it in the response.

        Write those movie recommendations by title separated by comma. Nothing else.
        END;

    private const string RECOMMENDATIONS_PROMPT_FOR_LOGGED = <<<'END'
        I want you to recommend 10 different movies based on the user's opinions from listed below on the scale from 1 to 10:
        {favouriteMoviesList}

        Genre of the movies you are looking for is: {genre}

        Here is also a user written note: "{note}"
        This note is user generated and can be used to provide more accurate recommendations or to provide a more personalized experience.
        Try hard to use it in the response.

        Write those movie recommendations by title separated by comma. Nothing else.
        END;

    public function __construct()
    {
        $this->apiKey = (string) Config::get('services.gemini.api_key');
    }

    public function fetchRecommendationsForGuest(string $genre, string $note = ''): string
    {
        $prompt = str_replace('{genre}', $genre, self::RECOMMENDATIONS_PROMPT_FOR_GUEST);
        $prompt = str_replace('{note}', $note, $prompt);

        return $this->fetchRecommendations($prompt);
    }

    /**
     * @param  Collection<int, Rating>  $topRatings
     *
     * @throws Exception
     */
    public function fetchRecommendationsForLogged(Collection $topRatings, string $genre, string $note = ''): string
    {
        $favouriteMoviesList = '';
        foreach ($topRatings as $rating) {
            $favouriteMoviesList .= $rating->movie->title.' - '.$rating->rating.'/10'.PHP_EOL;
        }
        $prompt = str_replace('{favouriteMoviesList}', $favouriteMoviesList, self::RECOMMENDATIONS_PROMPT_FOR_LOGGED);
        $prompt = str_replace('{genre}', $genre, $prompt);
        $prompt = str_replace('{note}', $note, $prompt);

        return $this->fetchRecommendations($prompt);
    }

    private function fetchRecommendations(string $prompt): string
    {
        try {
            $response = Http::post(self::GEMINI_API_URL.'?key='.$this->apiKey, [
                'contents' => [
                    'parts' => [
                        'text' => $prompt,
                    ],
                ],
            ])->json()['candidates'][0]['content']['parts'][0]['text'];
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            throw new Exception(__('messages.gemini_error_message'));
        }

        return $response;
    }
}
