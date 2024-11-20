<?php

namespace Tests\Feature\AiRecommendations;

use App\Models\Movie;
use App\Models\User;
use App\Services\Ai\Gemini\GeminiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Mockery\MockInterface;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class FetchRecommendationsTest extends TestCase
{
    use RefreshDatabase;

    private const string GEMINI_API_URL = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent';

    const array RESPONSE_FORMAT = [
        '*' => [
            'id',
            'tmdb_id',
            'created_at',
            'updated_at',
            'title',
            'title_pl',
            'tagline',
            'tagline_pl',
            'original_title',
            'release_date',
            'poster_path',
            'vote_average',
            'vote_count',
            'overview',
            'overview_pl',
            'original_language',
            'backdrop_path',
            'budget',
            'revenue',
            'runtime',
            'status',
            'adult',
            'origin_country',
            'directors',
            'screenwriters',
            'casting',
        ],
    ];

    public function test_guest_can_fetch_recommendations(): void
    {
        $movies = Movie::factory()->count(30)->create();
        $moviesTitlesSerialized = $movies->random(10)->pluck('title')->implode(', ');

        $this->mock(GeminiService::class, function (MockInterface $mock) use ($moviesTitlesSerialized) {
            $mock->shouldReceive('fetchRecommendationsForGuest')->once()->andReturn($moviesTitlesSerialized);
        });

        $response = $this->postJson('/get_recommendations', [
            'genre' => 'Any',
            'note' => 'Test note',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(self::RESPONSE_FORMAT);
    }

    public function test_external_api_error_fail_gracefully(): void
    {
        Http::fake([
            $this::GEMINI_API_URL => Http::response(null, Response::HTTP_INTERNAL_SERVER_ERROR),
        ]);

        $response = $this->postJson('/get_recommendations', [
            'genre' => 'Any',
            'note' => 'Test note',
        ]);

        $response->assertStatus(500)
            ->assertJson(['error' => __('messages.gemini_error_message')]);
    }

    public function test_guest_can_fetch_recommendations_without_note(): void
    {
        $movies = Movie::factory()->count(30)->create();
        $moviesTitlesSerialized = $movies->random(10)->pluck('title')->implode(', ');

        $this->mock(GeminiService::class, function (MockInterface $mock) use ($moviesTitlesSerialized) {
            $mock->shouldReceive('fetchRecommendationsForGuest')->once()->andReturn($moviesTitlesSerialized);
        });

        $response = $this->postJson('/get_recommendations', [
            'genre' => 'Any',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(self::RESPONSE_FORMAT
            );
    }

    public function test_logged_user_can_fetch_recommendations(): void
    {
        $user = User::factory()->create();
        $movies = Movie::factory()->count(30)->create();
        $moviesTitlesSerialized = $movies->random(10)->pluck('title')->implode(', ');

        $this->mock(GeminiService::class, function (MockInterface $mock) use ($moviesTitlesSerialized) {
            $mock->shouldReceive('fetchRecommendationsForLogged')->once()->andReturn($moviesTitlesSerialized);
        });

        $response = $this->actingAs($user)->postJson('/get_recommendations', [
            'genre' => 'Any',
            'note' => 'Test note',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(self::RESPONSE_FORMAT);
    }

    public function test_guest_can_get_working_recommendations_view(): void
    {
        $response = $this->get('/recommendations');
        $response->assertViewIs('recommendations.index');
        $response->assertStatus(200);
        $response->assertSee('AI Recommendations');
        $response->assertSee('Here you can receive personalized movie recommendations based on your input.');
        $response->assertSee('Log in');
        $response->assertSee('to get more personalized results using your movie ratings.');
    }

    public function test_logged_user_can_get_working_recommendations_view(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/recommendations');
        $response->assertViewIs('recommendations.index');
        $response->assertStatus(200);
        $response->assertSee('AI Recommendations');
        $response->assertSee('Here you can receive personalized movie recommendations based on your input and titles you rated.');
        $response->assertSee('It\'s a quick and easy way to discover new movies!');
    }
}
