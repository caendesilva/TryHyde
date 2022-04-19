<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the welcome page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(Request $request)
    {
        \App\Models\Stats::dispatch('site_views', 1);

        $preset = $this->getPreset($request);

        return view('welcome', [
            'preset' => $preset,
        ]);
    } 

    /**
     * Get the preset from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getPreset(Request $request)
    {
        if (! $request->has('preset')) {
            $selected = 'lorem';
        } else {
            $selected = $request->input('preset');
        }

        $path = resource_path('markdown/'.$selected.'.md');
        if (! file_exists($path)) {
            return 'Error: The preset "'.$selected.'" does not exist.';
        }

        return file_get_contents($path);
    }
}
