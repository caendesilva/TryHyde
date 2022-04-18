<?php

namespace Database\Seeders;

use App\Models\Stats;
use Illuminate\Database\Seeder;

class StatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stats::create([
            'event' => 'site_views',
            'value' => '0',
        ]);

        Stats::create([
            'event' => 'pages_downloaded',
            'value' => '0',
        ]);

        Stats::create([
            'event' => 'pages_generated',
            'value' => '0',
        ]);

        Stats::create([
            'event' => 'lines_of_html_generated',
            'value' => '0',
        ]);

        Stats::create([
            'event' => 'lines_of_markdown_converted',
            'value' => '0',
        ]);
    }
}
