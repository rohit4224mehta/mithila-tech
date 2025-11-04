<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials = [
            [
                'name' => 'Priya Sharma',
                'role' => 'Senior Developer',
                'tenure' => '3 years',
                'content' => 'The learning opportunities here are incredible. I\'ve grown more in three years than I did in seven at my previous company.',
                'image_url' => 'https://randomuser.me/api/portraits/women/32.jpg',
                'page' => 'careers',
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Chen',
                'role' => 'Cloud Architect',
                'tenure' => '2 years',
                'content' => 'The projects are challenging and the team is brilliant. Every day brings new opportunities to innovate.',
                'image_url' => 'https://randomuser.me/api/portraits/men/45.jpg',
                'page' => 'careers',
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Testimonial::insert($testimonials);
    }
}