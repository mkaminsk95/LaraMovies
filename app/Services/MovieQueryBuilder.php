<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class MovieQueryBuilder
{
    /**
     * @var Builder<Movie>
     */
    private Builder $query;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->query = Movie::query();
    }

    /**
     * @return Builder<Movie>
     */
    public function getResult(): Builder
    {
        return $this->query;
    }

    /**
     * @param  array<mixed>  $filters
     * @return void
     */
    public function applyFilters(array $filters): void
    {
        foreach ($filters as $key => $value) {
            if (! is_null($value) && method_exists($this, $method = 'filter'.ucfirst(Str::camel($key)))) {
                $this->$method($value);
            }
        }
    }

    /**
     * @param string $sorting
     * @return void
     */
    public function applySorting(string $sorting): void
    {
        [$attribute, $order] = explode('.', $sorting);
        $this->query->orderBy($attribute, $order);
    }

    /**
     * @param  array<string>  $genres
     * @return void
     */
    public function filterGenre(array $genres): void
    {
        $this->query->withGenre($genres);
    }

    /**
     * @param string $title
     * @return void
     */
    public function filterTitle(string $title): void
    {
        $this->query->withTitle($title);
    }

    /**
     * @param string $year
     * @return void
     */
    public function filterYear(string $year): void
    {
        $this->query->withYear($year);
    }

    /**
     * @param string|float $voteAverage
     * @return void
     */
    public function filterVoteAverage(string|float $voteAverage): void
    {
        $this->query->withVoteAverage($voteAverage);
    }
}
