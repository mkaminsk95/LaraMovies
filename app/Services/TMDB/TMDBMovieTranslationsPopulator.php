<?php
declare(strict_types=1);

namespace App\Services\TMDB;

use App\Models\Movie;

class TMDBMovieTranslationsPopulator implements MovieTranslationsPopulatorInterface
{
    const LANGUAGE_CODE_STANDARD = 'iso_639_1';

    private array $languages;
    private int $languagesCount;

    public function __construct(
        private readonly TMDBService $tmdbService,
    )
    {
        $this->languages = config()->get('app.available_locales');
        $this->languagesCount = count($this->languages);
    }

    public function populate(): void
    {
        foreach (Movie::all() as $movie) {
            echo $movie->title . PHP_EOL;
            $this->seedTranslations($movie);
        }
    }

    private function seedTranslations(Movie $movie): void
    {
        $translations = $this->provideTranslations($movie['tmdb_id']);
        $languagesFound = 0;

        foreach ($translations as $translation) {
            foreach ($this->languages as $language) {
                if ($translation[self::LANGUAGE_CODE_STANDARD] === $language) {
                    $this->updateMovie($movie, $translation, $language);
                }
            }
            if ($languagesFound === $this->languagesCount) {
                break;
            }
        }

        $movie->save();
    }

    private function provideTranslations(int $movieId): array
    {
        return $this->tmdbService->fetchTranslations($movieId);
    }

    private function updateMovie(Movie $movie, array $translation, string $language): void
    {
        if ($language === 'en') {
            $movie['tagline'] = $translation['data']['tagline'];
        } else {
            $movie['title_' . $language] = $translation['data']['title'] ?: $movie['title'];
            $movie['tagline_' . $language] = $translation['data']['tagline'];
            $movie['overview_' . $language] = $translation['data']['overview'] ?: $movie['overview'];
        }
    }
}
