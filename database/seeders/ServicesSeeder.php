<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        DB::table('heroes')->insert([
            ['page' => 'services', 'title' => 'Our Services', 'subtitle' => 'Comprehensive IT solutions for your business.', 'background_image' => 'images/services-bg.jpg', 'call_to_action' => 'Explore Now', 'quote' => 'Empowering your future.', 'focus_areas' => 'Technology, Innovation', 'created_at' => now(), 'updated_at' => now()],
            ['page' => 'solutions', 'title' => 'Our Innovative Solutions', 'subtitle' => 'Cutting-edge IT solutions to transform your business', 'background_image' => 'images/tech-bg.jpg', 'call_to_action' => 'Explore Solutions', 'quote' => 'Transforming businesses with technology.', 'focus_areas' => 'Innovation, Scalability', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('services_overviews')->insert([
            ['badge' => 'Our Expertise', 'title' => 'Our IT Services', 'description' => 'Delivering cutting-edge IT solutions tailored to your needs.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('services')->insert([
            ['name' => 'Web Development', 'short_description' => 'Custom web solutions for your business.', 'icon' => 'bi-code-slash', 'slug' => 'web-development', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AI Integration', 'short_description' => 'Implement AI to enhance operations.', 'icon' => 'bi-robot', 'slug' => 'ai-integration', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cloud Solutions', 'short_description' => 'Scalable and secure cloud services.', 'icon' => 'bi-cloud', 'slug' => 'cloud-solutions', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('partners')->insert([
            ['badge' => 'Partners', 'title' => 'Our Technology Partners', 'description' => 'We collaborate with leading tech companies to deliver exceptional solutions.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('partner_logos')->insert([
            ['partner_id' => 1, 'name' => 'AWS', 'image_url' => 'images/partners/aws.png', 'created_at' => now(), 'updated_at' => now()],
            ['partner_id' => 1, 'name' => 'Google Cloud', 'image_url' => 'images/partners/google-cloud.png', 'created_at' => now(), 'updated_at' => now()],
            ['partner_id' => 1, 'name' => 'Microsoft Azure', 'image_url' => 'images/partners/azure.png', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('processes')->insert([
            ['badge' => 'Our Approach', 'title' => 'How We Work', 'lead_description' => 'A streamlined process to deliver results.', 'additional_description' => 'We follow a proven methodology to ensure success.', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('process_steps')->insert([
            ['process_id' => 1, 'title' => 'Discovery', 'description' => 'Understand client needs and goals.', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['process_id' => 1, 'title' => 'Design', 'description' => 'Create tailored solutions.', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['process_id' => 1, 'title' => 'Delivery', 'description' => 'Implement and support.', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('ctas')->insert([
            ['page' => 'services', 'title' => 'Ready to Transform?', 'description' => 'Let’s build your future with our IT solutions.', 'phone' => '+977-123-456-7890', 'call_to_action' => 'Contact Us', 'created_at' => now(), 'updated_at' => now()],
            ['page' => 'solutions', 'title' => 'Ready to Transform Your Business?', 'description' => 'Let’s discuss how our solutions can drive your digital transformation', 'phone' => '+977-123-456-7890', 'call_to_action' => 'Contact Us', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('solutions_overviews')->insert([
            ['badge' => 'Our Solutions', 'title' => 'Our Solution Offerings', 'description' => 'Tailored technology solutions for your business challenges', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('solutions')->insert([
            ['name' => 'Enterprise AI', 'description' => 'AI-driven solutions for enterprises.', 'slug' => 'enterprise-ai', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cloud Migration', 'description' => 'Seamless cloud migration services.', 'slug' => 'cloud-migration', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cybersecurity Suite', 'description' => 'Advanced security for your business.', 'slug' => 'cybersecurity-suite', 'status' => 'published', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('case_studies_overviews')->insert([
            ['badge' => 'Case Studies', 'title' => 'Our Success Stories', 'description' => 'Real-world solutions delivering measurable results', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('testimonials')->insert([
            ['quote' => 'Mithila Tech transformed our business!', 'author' => 'John Doe', 'company' => 'Example Corp', 'created_at' => now(), 'updated_at' => now()],
            ['quote' => 'Outstanding solutions and support.', 'author' => 'Jane Smith', 'company' => 'Tech Ltd', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}