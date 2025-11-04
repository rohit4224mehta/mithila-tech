<?php

   namespace Database\Seeders;

   use Illuminate\Database\Seeder;
   use App\Models\Career;

   class CareerSeeder extends Seeder
   {
       public function run()
       {
           Career::create([
               'title' => 'Senior Software Engineer',
               'slug' => 'senior-software-engineer',
               'location' => 'Kathmandu, Nepal',
               'type' => 'Full-time',
               'experience' => '5+ years',
               'category' => 'developer',
               'description' => 'Lead development of innovative software solutions.',
               'benefits' => json_encode(['Competitive salary', 'Health insurance', 'Flexible hours']),
               'status' => 'open',
           ]);

           Career::create([
               'title' => 'UI/UX Designer',
               'slug' => 'ui-ux-designer',
               'location' => 'Remote',
               'type' => 'Part-time',
               'experience' => '3+ years',
               'category' => 'designer',
               'description' => 'Design user-friendly interfaces for our applications.',
               'benefits' => json_encode(['Flexible hours', 'Professional growth', 'Remote work']),
               'status' => 'open',
           ]);
       }
   }