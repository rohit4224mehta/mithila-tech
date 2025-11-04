<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use App\Models\Hero;
use App\Models\Vision;
use App\Models\Approach;
use App\Models\Step;
use App\Models\Building;
use App\Models\Offering;
use App\Models\Standout;
use App\Models\Strength;
use App\Models\WhoWeAre;
use App\Models\Founder;
use App\Models\Insight;
use App\Models\About;
use App\Models\Value;
use App\Models\Milestone;
use App\Models\TeamMember;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Media;
use App\Models\Process;
use App\Models\ProcessStep;
use App\Models\Partner;
use App\Models\Subscriber;
use App\Models\ServicesOverview;
use App\Models\SolutionsOverview;
use App\Models\Solution;
use App\Models\CaseStudiesOverview;
use App\Models\CultureValue;
use App\Models\Application;
use App\Models\Contact;
use Illuminate\Support\Str;

/**
 * Class WelcomeController
 * Handles the main public-facing pages for Mithila Tech.
 * Last updated: October 12, 2025
 */
class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $hero = Cache::remember('hero_home', 3600, fn() => Hero::where('page', 'home')->first() ?? (object)[
                'title' => 'Welcome to Mithila Tech',
                'subtitle' => 'Innovative IT Solutions',
                'background_image' => asset('images/hero-bg.jpg'),
                'call_to_action' => 'Get Started',
                'quote' => 'Empowering your future.',
                'focus_areas' => 'Innovation, Technology',
            ]);

            $vision = Cache::remember('vision_home', 3600, fn() => Vision::first() ?? (object)[]);
            $approach = Cache::remember('approach_home', 3600, fn() => Approach::first() ?? (object)[]);
            $steps = Cache::remember('steps_home', 3600, fn() => Step::orderBy('order')->get() ?? collect());
            $building = Cache::remember('building_home', 3600, fn() => Building::first() ?? (object)[]);
            $offerings = Cache::remember('offerings_home', 3600, fn() => Offering::orderBy('created_at', 'desc')->take(4)->get() ?? collect());
            $standout = Cache::remember('standout_home', 3600, fn() => Standout::first() ?? (object)[]);
            $strengths = Cache::remember('strengths_home', 3600, fn() => Strength::orderBy('created_at', 'desc')->take(3)->get() ?? collect());
            $whoWeAre = Cache::remember('who_we_are_home', 3600, fn() => WhoWeAre::first() ?? (object)[]);
            $founders = Cache::remember('founders_home', 3600, fn() => Founder::orderBy('created_at', 'desc')->take(2)->get() ?? collect());
            $insights = Cache::remember('insights_home', 3600, fn() => Insight::with('posts')->first() ?? (object)[]);

            View::share('pageTitle', 'Home - Mithila Tech');
            View::share('metaDescription', 'Explore Mithila Tech, a Nepal-based IT startup innovating with AI, NanoTech, and smart software solutions.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Home page loaded', [
                'url' => $request->url(),
                'offerings_count' => $offerings->count(),
            ]);

            return view('home', compact(
                'hero', 'vision', 'approach', 'steps', 'building',
                'offerings', 'standout', 'strengths', 'whoWeAre', 'founders', 'insights'
            ));
        } catch (\Exception $e) {
            Log::error('Home page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function about(Request $request)
    {
        try {
            $aboutData = Cache::remember('about_page', 3600, fn() => About::first() ?? (object)[
                'image_url' => asset('images/mission.jpg'),
                'description' => 'Mithila Tech is a Nepal-based IT startup revolutionizing technology with innovative solutions in AI, NanoTech, and smart software.',
                'founded_year' => 2020,
                'team_size' => 50,
                'countries_served' => 10,
            ]);

            $values = Cache::remember('values_about', 3600, fn() => Value::all() ?? collect());
            $milestones = Cache::remember('milestones_about', 3600, fn() => Milestone::orderBy('year')->get() ?? collect());
            $teamMembers = Cache::remember('team_members_about', 3600, fn() => TeamMember::all() ?? collect());
            $services = Cache::remember('services_about', 3600, fn() => Service::take(6)->get() ?? collect());
            $testimonials = Cache::remember('testimonials_about', 3600, fn() => Testimonial::all() ?? collect());

            View::share('pageTitle', 'About Us - Mithila Tech');
            View::share('metaDescription', 'Discover Mithila Tech\'s journey, values, and team driving innovation in Nepal\'s IT sector.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('About page loaded', [
                'url' => $request->url(),
                'team_count' => $teamMembers->count(),
            ]);

            return view('about', compact('aboutData', 'values', 'milestones', 'teamMembers', 'services', 'testimonials'));
        } catch (\Exception $e) {
            Log::error('About page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function contact(Request $request)
    {
        try {
            View::share('pageTitle', 'Contact Us - Mithila Tech');
            View::share('metaDescription', 'Get in touch with Mithila Tech for inquiries, partnerships, or support.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Contact page loaded', ['url' => $request->url()]);

            return view('contact');
        } catch (\Exception $e) {
            Log::error('Contact page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function submitContact(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
                'consent' => 'required|accepted',
            ]);

            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            Log::info('Contact form submitted', [
                'email' => $request->email,
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
            ]);

            return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you within 24 hours.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Contact form validation failed', [
                'errors' => $e->errors(),
                'url' => $request->url(),
            ]);
            return redirect()->route('contact')->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Contact form error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('contact')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function terms(Request $request)
    {
        try {
            View::share('pageTitle', 'Terms & Conditions - Mithila Tech');
            View::share('metaDescription', 'Review the terms and conditions of using Mithila Tech\'s services.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Terms page loaded', ['url' => $request->url()]);

            return view('terms');
        } catch (\Exception $e) {
            Log::error('Terms page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function privacy(Request $request)
    {
        try {
            View::share('pageTitle', 'Privacy Policy - Mithila Tech');
            View::share('metaDescription', 'Learn about Mithila Tech\'s privacy policy and how we protect your data.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Privacy page loaded', ['url' => $request->url()]);

            return view('privacy');
        } catch (\Exception $e) {
            Log::error('Privacy page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function support(Request $request)
    {
        try {
            View::share('pageTitle', 'Support - Mithila Tech');
            View::share('metaDescription', 'Access support resources and assistance from Mithila Tech\'s team.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Support page loaded', ['url' => $request->url()]);

            return view('support');
        } catch (\Exception $e) {
            Log::error('Support page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function media(Request $request)
    {
        try {
            $mediaItems = Cache::remember('media_page', 3600, fn() => Media::orderBy('published_at', 'desc')->paginate(9) ?? collect());

            View::share('pageTitle', 'Media - Mithila Tech');
            View::share('metaDescription', 'Latest news, press releases, and media coverage about Mithila Tech.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Media page loaded', [
                'url' => $request->url(),
                'media_count' => $mediaItems->count(),
            ]);

            return view('media', compact('mediaItems'));
        } catch (\Exception $e) {
            Log::error('Media page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function careers(Request $request)
    {
        try {
            $careers = Cache::remember('careers_page', 3600, fn() => Career::where('status', 'open')->get() ?? collect());
            $cultureValues = Cache::remember('culture_values_careers', 3600, fn() => CultureValue::all() ?? collect());
            $testimonials = Cache::remember('testimonials_careers', 3600, fn() => Testimonial::all() ?? collect());

            foreach ($careers as $career) {
                $career->benefits = is_string($career->benefits) && json_decode($career->benefits, true)
                    ? json_decode($career->benefits, true)
                    : ['Competitive salary', 'Flexible hours', 'Professional growth'];
            }

            View::share('pageTitle', 'Careers - Mithila Tech');
            View::share('metaDescription', 'Join Mithila Tech and advance your career in innovative IT solutions.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Careers page loaded', [
                'url' => $request->url(),
                'careers_count' => $careers->count(),
            ]);

            return view('careers', compact('careers', 'cultureValues', 'testimonials'));
        } catch (\Exception $e) {
            Log::error('Careers page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function careerApply(Career $career)
    {
        try {
            if (!$career || $career->status !== 'open') {
                Log::warning('Career not found or not open', [
                    'slug' => $career->slug ?? 'unknown',
                    'url' => request()->url(),
                ]);
                return view('errors.404')->with('message', 'This position is no longer available.');
            }

            // Check if view exists
            if (!view()->exists('career-apply')) {
                Log::error('Career apply view not found', [
                    'view' => 'career-apply',
                    'url' => request()->url(),
                ]);
                return view('errors.500')->with('message', 'Career application page is unavailable.');
            }

            View::share('pageTitle', "Apply for {$career->title} - Mithila Tech");
            View::share('metaDescription', "Apply for the {$career->title} position at Mithila Tech and join our innovative team.");
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Career apply page loaded', [
                'slug' => $career->slug,
                'career_id' => $career->id,
                'url' => request()->url(),
            ]);

            return view('career-apply', compact('career'));
        } catch (\Exception $e) {
            Log::error('Career apply page error', [
                'message' => $e->getMessage(),
                'slug' => $career->slug ?? 'unknown',
                'url' => request()->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500')->with('message', 'An error occurred while loading the application page.');
        }
    }

    public function submitCareerApplication(Request $request, Career $career)
    {
        try {
            if (!$career || $career->status !== 'open') {
                Log::warning('Career not found or not open for application', [
                    'slug' => $career->slug ?? 'unknown',
                    'url' => $request->url(),
                ]);
                return redirect()->route('careers')->with('error', 'This position is no longer available.');
            }

            $validated = $request->validate([
                'name' => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'cover_letter' => 'nullable|string|max:2000',
                'resume' => 'required|file|mimes:pdf|max:2048',
            ]);

            if (!Storage::disk('public')->exists('resumes')) {
                Storage::disk('public')->makeDirectory('resumes');
            }

            $resumePath = $request->file('resume')->store('resumes', 'public');

            $application = Application::create([
                'career_id' => $career->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'cover_letter' => $validated['cover_letter'],
                'resume_path' => $resumePath,
                'status' => 'pending',
            ]);

            // Send confirmation email to applicant
            Mail::send('emails.application_confirmation', ['career' => $career, 'application' => $application], function ($message) use ($application) {
                $message->to($application->email)->subject('Application Received - Mithila Tech');
            });

            // Send notification to HR
            Mail::send('emails.application_notification', ['career' => $career, 'application' => $application], function ($message) use ($career) {
                $message->to('hr@mithilatech.com')->subject("New Application: {$career->title}");
            });

            Log::info('Career application submitted', [
                'career_id' => $career->id,
                'application_id' => $application->id,
                'email' => $application->email,
                'resume_path' => $resumePath,
                'url' => $request->url(),
            ]);

            return redirect()->route('career.apply', $career->slug)->with('success', 'Your application has been submitted successfully! Check your email for confirmation.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Career application validation failed', [
                'slug' => $career->slug ?? 'unknown',
                'errors' => $e->errors(),
                'url' => $request->url(),
            ]);
            return redirect()->route('career.apply', $career->slug)->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Career application error', [
                'message' => $e->getMessage(),
                'slug' => $career->slug ?? 'unknown',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->route('career.apply', $career->slug)->with('error', 'An error occurred while submitting your application. Please try again.');
        }
    }

    public function solutions(Request $request)
    {
        try {
            $solutions = Cache::remember('solutions_page', 3600, fn() => Solution::all() ?? collect());
            $overview = Cache::remember('solutions_overview', 3600, fn() => SolutionsOverview::first() ?? (object)[]);
            $caseStudiesOverview = Cache::remember('case_studies_overview', 3600, fn() => CaseStudiesOverview::first() ?? (object)[]);
            $testimonials = Cache::remember('testimonials_solutions', 3600, fn() => Testimonial::all() ?? collect());

            View::share('pageTitle', 'Solutions - Mithila Tech');
            View::share('metaDescription', 'Discover our comprehensive IT solutions tailored for your business needs.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Solutions page loaded', [
                'url' => $request->url(),
                'solutions_count' => $solutions->count(),
            ]);

            return view('solutions', compact('solutions', 'overview', 'caseStudiesOverview', 'testimonials'));
        } catch (\Exception $e) {
            Log::error('Solutions page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function showSolution(Solution $solution)
    {
        try {
            $solution = Cache::remember("solution_{$solution->slug}", 3600, fn() => $solution);

            View::share('pageTitle', "{$solution->title} - Mithila Tech");
            View::share('metaDescription', Str::limit($solution->description, 160));
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Solution detail page loaded', [
                'slug' => $solution->slug,
                'solution_id' => $solution->id,
                'url' => request()->url(),
            ]);

            return view('solution-detail', compact('solution'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Solution not found', [
                'slug' => $solution->slug ?? 'unknown',
                'url' => request()->url(),
            ]);
            return view('errors.404');
        } catch (\Exception $e) {
            Log::error('Solution detail page error', [
                'message' => $e->getMessage(),
                'slug' => $solution->slug ?? 'unknown',
                'url' => request()->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function services(Request $request)
    {
        try {
            $services = Cache::remember('services_page', 3600, fn() => Service::all() ?? collect());
            $overview = Cache::remember('services_overview', 3600, fn() => ServicesOverview::first() ?? (object)[]);

            View::share('pageTitle', 'Services - Mithila Tech');
            View::share('metaDescription', 'Explore our range of IT services designed to drive your business forward.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Services page loaded', [
                'url' => $request->url(),
                'services_count' => $services->count(),
            ]);

            return view('services', compact('services', 'overview'));
        } catch (\Exception $e) {
            Log::error('Services page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function serviceDetail(Service $service)
    {
        try {
            $service = Cache::remember("service_{$service->slug}", 3600, fn() => $service);

            View::share('pageTitle', "{$service->title} - Mithila Tech");
            View::share('metaDescription', Str::limit($service->description, 160));
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Service detail page loaded', [
                'slug' => $service->slug,
                'service_id' => $service->id,
                'url' => request()->url(),
            ]);

            return view('service-detail', compact('service'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Service not found', [
                'slug' => $service->slug ?? 'unknown',
                'url' => request()->url(),
            ]);
            return view('errors.404');
        } catch (\Exception $e) {
            Log::error('Service detail page error', [
                'message' => $e->getMessage(),
                'slug' => $service->slug ?? 'unknown',
                'url' => request()->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function processDetail(Request $request)
    {
        try {
            $process = Cache::remember('process_page', 3600, fn() => Process::first() ?? (object)[]);
            $steps = Cache::remember('process_steps', 3600, fn() => ProcessStep::orderBy('order')->get() ?? collect());

            View::share('pageTitle', 'Our Process - Mithila Tech');
            View::share('metaDescription', 'Understand our systematic approach to delivering exceptional IT solutions.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Process detail page loaded', [
                'url' => $request->url(),
                'steps_count' => $steps->count(),
            ]);

            return view('process', compact('process', 'steps'));
        } catch (\Exception $e) {
            Log::error('Process detail page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function global(Request $request)
    {
        try {
            $partners = Cache::remember('partners_global', 3600, fn() => Partner::with('logos')->get() ?? collect());

            View::share('pageTitle', 'Global Presence - Mithila Tech');
            View::share('metaDescription', 'Explore Mithila Tech\'s global reach and partnerships.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Global page loaded', [
                'url' => $request->url(),
                'partners_count' => $partners->count(),
            ]);

            return view('global', compact('partners'));
        } catch (\Exception $e) {
            Log::error('Global page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function blog(Request $request)
    {
        try {
            $blogs = Cache::remember('blog_page', 3600, fn() => Blog::where('status', 'published')->orderBy('published_at', 'desc')->paginate(9) ?? collect());

            View::share('pageTitle', 'Blog - Mithila Tech');
            View::share('metaDescription', 'Latest insights and articles from Mithila Tech\'s experts.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Blog page loaded', [
                'url' => $request->url(),
                'blogs_count' => $blogs->count(),
            ]);

            return view('blog', compact('blogs'));
        } catch (\Exception $e) {
            Log::error('Blog page error', [
                'message' => $e->getMessage(),
                'user_id' => auth()->id() ?? 'guest',
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function showBlog(Blog $blog)
    {
        try {
            $blog = Cache::remember("blog_{$blog->slug}", 3600, fn() => $blog->where('status', 'published')->firstOrFail());

            View::share('pageTitle', "{$blog->title} - Mithila Tech Blog");
            View::share('metaDescription', Str::limit($blog->content, 160));
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Blog post loaded', [
                'slug' => $blog->slug,
                'blog_id' => $blog->id,
                'url' => request()->url(),
            ]);

            return view('blog-show', compact('blog'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Blog post not found', [
                'slug' => $blog->slug ?? 'unknown',
                'url' => request()->url(),
            ]);
            return view('errors.404');
        } catch (\Exception $e) {
            Log::error('Blog post error', [
                'message' => $e->getMessage(),
                'slug' => $blog->slug ?? 'unknown',
                'url' => request()->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function showCategory($category)
    {
        try {
            $blogs = Cache::remember("blog_category_{$category}", 3600, fn() => Blog::where('category', $category)->where('status', 'published')->orderBy('published_at', 'desc')->paginate(9) ?? collect());

            View::share('pageTitle', ucfirst($category) . ' Blog - Mithila Tech');
            View::share('metaDescription', "Explore our latest articles in the {$category} category.");
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Blog category loaded', [
                'category' => $category,
                'url' => request()->url(),
                'blogs_count' => $blogs->count(),
            ]);

            return view('blog-category', compact('blogs', 'category'));
        } catch (\Exception $e) {
            Log::error('Blog category error', [
                'message' => $e->getMessage(),
                'category' => $category,
                'url' => request()->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }

    public function subscribe(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|max:255|unique:subscribers,email',
            ]);

            Subscriber::create([
                'email' => $request->email,
            ]);

            Log::info('Newsletter subscription', [
                'email' => $request->email,
                'url' => $request->url(),
            ]);

            return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Subscription validation failed', [
                'errors' => $e->errors(),
                'url' => $request->url(),
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Subscription error', [
                'message' => $e->getMessage(),
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $results = [];

            if ($query && strlen($query) >= 3) {
                $tables = ['blogs', 'services', 'solutions', 'media'];

                foreach ($tables as $table) {
                    if (Schema::hasTable($table)) {
                        $model = 'App\\Models\\' . ucfirst(Str::singular($table));
                        $results[$table] = $model::where('title', 'like', "%{$query}%")
                            ->orWhere('description', 'like', "%{$query}%")
                            ->orWhere('content', 'like', "%{$query}%")
                            ->get() ?? collect();
                    }
                }
            }

            View::share('pageTitle', 'Search Results - Mithila Tech');
            View::share('metaDescription', 'Search results for your query on Mithila Tech.');
            View::share('currentTime', now()->setTimezone('Asia/Kolkata')->format('g:i A T, F j, Y'));

            Log::info('Search performed', [
                'query' => $query,
                'url' => $request->url(),
                'results_count' => collect($results)->flatten()->count(),
            ]);

            return view('search', compact('results', 'query'));
        } catch (\Exception $e) {
            Log::error('Search error', [
                'message' => $e->getMessage(),
                'query' => $request->input('query'),
                'url' => $request->url(),
                'trace' => $e->getTraceAsString(),
            ]);
            return view('errors.500');
        }
    }
}
