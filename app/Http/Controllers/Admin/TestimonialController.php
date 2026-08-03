<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::with('category')->latest()->paginate(12);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        $categories = Category::where('module', Category::MODULE_TESTIMONIAL)
            ->where('status', 'active')->get();

        return view('admin.testimonials.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'comments' => ['required', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        $categories = Category::where('module', Category::MODULE_TESTIMONIAL)
            ->where('status', 'active')->get();

        return view('admin.testimonials.edit', compact('testimonial', 'categories'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'comments' => ['required', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return back()->with('success', 'Testimonial deleted successfully.');
    }
}
