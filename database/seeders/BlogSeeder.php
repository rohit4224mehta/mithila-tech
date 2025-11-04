<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::create([
            'title' => 'The Future of Hybrid Cloud Solutions',
            'slug' => 'future-hybrid-cloud-solutions',
            'content' => 'Exploring how hybrid cloud architectures are becoming the standard for enterprise IT infrastructure in 2025.',
            'image' => 'images/cloud.jpg',
            'category' => 'Cloud Computing',
            'tags' => 'Cloud,Trends',
            'author' => 'Michael Chen',
            'published_at' => '2025-07-18',
            'status' => 'published',
        ]);

        Blog::create([
            'title' => 'Zero Trust Security in 2025',
            'slug' => 'zero-trust-security-2025',
            'content' => 'Implementing Zero Trust architectures to protect against evolving cyber threats in the modern digital landscape.',
            'image' => 'images/zero.png',
            'category' => 'Cybersecurity',
            'tags' => 'Cybersecurity,Best Practices',
            'author' => 'Sarah Johnson',
            'published_at' => '2025-07-05',
            'status' => 'published',
        ]);

        Blog::create([
            'title' => 'Generative AI in Enterprise Applications',
            'slug' => 'generative-ai-enterprise',
            'content' => 'How businesses are leveraging generative AI to transform customer experiences and operational efficiency.',
            'image' => 'images/Ai.jpg',
            'category' => 'AI/ML',
            'tags' => 'AI/ML,Innovation',
            'author' => 'David Park',
            'published_at' => '2025-06-28',
            'status' => 'published',
        ]);

        Blog::create([
            'title' => 'The 2025 Digital Transformation Playbook',
            'slug' => 'digital-transformation-playbook-2025',
            'content' => 'Comprehensive guide to navigating digital transformation in the post-AI era with actionable insights for IT leaders.',
            'image' => 'images/digital.jpg',
            'category' => 'Digital Transformation',
            'tags' => 'Digital Transformation,Strategy',
            'author' => 'Lisa Rodriguez',
            'published_at' => '2025-07-10',
            'status' => 'published',
        ]);
    }
}