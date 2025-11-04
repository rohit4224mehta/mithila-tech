<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CultureValue;

class CultureValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cultureValues = [
            [
                'title' => 'Collaborative Spirit',
                'description' => 'Work with brilliant minds in an environment that values teamwork and knowledge sharing.',
                'icon' => 'bi-people-fill',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Growth Focused',
                'description' => 'Continuous learning opportunities with mentorship programs and skill development budgets.',
                'icon' => 'bi-graph-up',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Work-Life Balance',
                'description' => 'Flexible schedules, remote options, and generous time-off policies to support your well-being.',
                'icon' => 'bi-heart-fill',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        CultureValue::insert($cultureValues);
    }
}