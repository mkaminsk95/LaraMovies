<?php

declare(strict_types=1);

namespace Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_get_movie_list(): void
    {
        Movie::factory()->count(100)->create();

        $response = $this->get(route('movies.index'));

        $viewData = $response->viewData('paginatedMovies');
        $firstMovie = $viewData->collect()->first();
        $lastMovie = $viewData->collect()->last();

        $response->assertStatus(200)
            ->assertSee($firstMovie->title)
            ->assertSee($lastMovie->title);
    }

    public function test_guest_movie_list_view_is_correct(): void
    {
        Movie::factory()->count(10)->create();

        $response = $this->get(route('movies.index'));

        $response->assertStatus(200)
            ->assertViewIs('movies.index')
            ->assertViewHas('paginatedMovies')
            ->assertViewHas('genres')
            ->assertViewHas('query');
    }

    public function test_guest_can_filter_movies_by_name(): void
    {
        $movieToBeFound = Movie::factory()->count(100)->create()->first();

        $response = $this->get(route('movies.index', ['title' => $movieToBeFound->title]));

        $response->assertStatus(200)
            ->assertSee($movieToBeFound->title);
    }

    public function test_guest_can_filter_movies_by_year(): void
    {
        $year = '2000';
        Movie::factory()->count(20)->create();
        Movie::factory()->count(2)->create(['release_date' => $year.'-01-01']);

        $response = $this->get(route('movies.index', ['year' => $year]));

        $response->assertStatus(200)
            ->assertSee($year);

        $movies = $response->viewData('paginatedMovies');
        $movies->each(function ($movie) use ($year) {
            $this->assertEquals($year, str_contains($movie->release_date, $year));
        });
    }

    public function test_guest_can_filter_movies_by_vote_average(): void
    {
        $voteAverage = '9';
        Movie::factory()->count(10)->create();
        Movie::factory()->count(2)->create(['vote_average' => '9.5']);

        $response = $this->get(route('movies.index', ['vote-average' => $voteAverage]));

        $response->assertStatus(200)
            ->assertSee($voteAverage);

        $movies = $response->viewData('paginatedMovies');
        $movies->each(function ($movie) use ($voteAverage) {
            $this->assertTrue($movie->vote_average >= $voteAverage);
        });
    }
}
