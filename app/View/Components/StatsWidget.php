<?php

namespace App\View\Components;

use App\Models\Stats;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StatsWidget extends Component
{
    public Collection $stats;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->stats = Stats::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stats-widget');
    }
}
