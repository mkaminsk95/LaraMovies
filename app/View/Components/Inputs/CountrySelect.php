<?php

declare(strict_types=1);

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountrySelect extends Component
{
    public string $label;

    public string $selected;

    public function __construct(string $label, ?string $selected = null)
    {
        $this->label = $label;
        $this->selected = $selected;
    }

    public function render(): View|Closure|string
    {
        return view('components.inputs.country-select');
    }

    /**
     * @return array<string, string>
     */
    public function getMovieLanguages(): array
    {
        return config('movie_languages');
    }
}
