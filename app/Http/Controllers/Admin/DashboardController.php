<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PhotoGallery;
use App\Models\Testimonial;
use App\Models\VideoGallery;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'photos' => PhotoGallery::count(),
            'videos' => VideoGallery::count(),
            'testimonials' => Testimonial::count(),
        ];

        $recentPhotos = PhotoGallery::with('category')->latest()->take(5)->get();
        $recentTestimonials = Testimonial::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPhotos', 'recentTestimonials'));
    }
}
