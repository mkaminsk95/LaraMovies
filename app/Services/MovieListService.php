<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Movie;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class MovieListService
{
    const int MOVIE_PAGE_CACHE_TTL = 60;

    public function __construct(
        private MovieQueryBuilder $movieQueryBuilder
    ) {}

    /**
     * @param array<string, mixed> $filters
     * @param string $sorting
     * @param int $perPage
     * @return LengthAwarePaginator<Movie>
     */
    public function getPaginatedList(array $filters = [], string $sorting = 'vote_average.desc', int $perPage = 15): LengthAwarePaginator
    {
        $this->movieQueryBuilder->applyFilters($filters);
        $this->movieQueryBuilder->applySorting($sorting);

        $currentPage = request('page', 1);
        $cacheKey = $this->constructCacheKey($currentPage, $perPage);

        return Cache::remember($cacheKey, self::MOVIE_PAGE_CACHE_TTL, function () use ($perPage) {
            return $this->movieQueryBuilder->getResult()->paginate($perPage);
        });
    }

    private function constructCacheKey(int $currentPage, int $perPage): string
    {
        return 'movies_page_' . $currentPage . '_' . $perPage;
    }

    /**
     * @param array<string, mixed> $filters
     * @param string $sorting
     * @return Collection<int, Movie>
     */
    public function getList(array $filters = [], string $sorting = 'vote_average.desc'): Collection
    {
        $this->movieQueryBuilder->applyFilters($filters);
        $this->movieQueryBuilder->applySorting($sorting);

        return $this->movieQueryBuilder->getResult()->get();
    }
}
