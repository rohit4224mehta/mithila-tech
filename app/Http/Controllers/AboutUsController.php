<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Models\TeamMember;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first(); // Optional: general about info
        $teamMembers = TeamMember::all(); // All team members

        return view('about', compact('about', 'teamMembers'));
    }
}
