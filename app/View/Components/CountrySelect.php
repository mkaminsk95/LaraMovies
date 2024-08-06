<?php
declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountrySelect extends Component
{
    public $label;
    public $selected;

    public function __construct($label, $selected = null)
    {
        $this->label = $label;
        $this->selected = $selected;
    }

    public function render(): View|Closure|string
    {
        return view('components.country-select');
    }

    public function getMovieLanguages(): array
    {
        return config('movie_languages');
    }
}
