<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run()
    {
        Media::create([
            'title' => 'Volera Wins IT Innovation Award',
            'description' => 'Recognized for excellence in cloud solutions, July 2025',
            'type' => 'highlight',
            'source' => 'Tech Journal',
            'image' => 'images/admi.png',
            'link' => 'https://example.com/article',
            'published_at' => '2025-07-15',
            'tags' => 'Award,Cloud',
            'status' => 'published',
        ]);

        Media::create([
            'title' => 'New Partnership with TechCorp',
            'description' => 'Announced a strategic alliance, June 2025',
            'type' => 'highlight',
            'source' => 'Business Today',
            'image' => 'images/ladki.jpg',
            'link' => 'https://example.com/partnership',
            'published_at' => '2025-06-28',
            'tags' => 'Partnership,Tech',
            'status' => 'published',
        ]);

        Media::create([
            'title' => 'Volera Expands to Europe',
            'description' => 'Opened new office in London to better serve our European clients and partners.',
            'type' => 'press_release',
            'source' => null,
            'image' => null,
            'link' => 'downloads/europe-expansion.pdf',
            'published_at' => '2025-07-10',
            'tags' => 'Expansion,New Office',
            'status' => 'published',
        ]);

        Media::create([
            'title' => 'New Executive Appointments',
            'description' => 'Announced new leadership team to drive next phase of company growth.',
            'type' => 'press_release',
            'source' => null,
            'image' => null,
            'link' => 'downloads/executive-appointments.pdf',
            'published_at' => '2025-06-05',
            'tags' => 'Leadership,Management',
            'status' => 'published',
        ]);
    }
}