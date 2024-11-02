<?php

namespace App\Http\Resources;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieRecommendationResource extends JsonResource
{
    /**
     * @return array<Movie>
     */
    public function toArray(Request $request): array
    {
        $movieArray = parent::toArray($request);

        // Add additional fields to the array
        $this->includeCredits($movieArray);

        return $movieArray;
    }

    /**
     * @param  array<Movie>  $movieArray
     */
    private function includeCredits(array &$movieArray): void
    {
        $this->includeDirectors($movieArray);
        $this->includeScreenwriters($movieArray);
        $this->includeCasting($movieArray);
    }

    /**
     * @param  array<Movie>  $movieArray
     */
    private function includeDirectors(array &$movieArray): void
    {
        $directors = $this->resource->credits()
            ->withDepartment('Director')
            ->get();
        $directors = $directors->map(function ($director) {
            return $director->person->name;
        })->implode(', ');

        $movieArray['directors'] = $directors;
    }

    /**
     * @param  array<Movie>  $movieArray
     */
    private function includeScreenwriters(array &$movieArray): void
    {
        $screenwriters = $this->resource->credits()
            ->withDepartment('Screenplay')
            ->get();
        $screenwriters = $screenwriters
            ->map(function ($screenwriter) {
                return $screenwriter->person->name;
            })->implode(', ');

        $movieArray['screenwriters'] = $screenwriters;
    }

    /**
     * @param  array<Movie>  $movieArray
     */
    private function includeCasting(array &$movieArray): void
    {
        $casting = $this->resource->credits()
            ->withDepartment('Acting')
            ->with('Person')
            ->get()
            ->sortByDesc(function ($credit) {
                return $credit->person->popularity;
            })->take(4)
            ->map(function ($credit) {
                return $credit->person->name;
            })->implode(', ');

        $movieArray['casting'] = $casting;
    }
}
