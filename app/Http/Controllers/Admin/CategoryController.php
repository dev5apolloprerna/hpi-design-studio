<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query()->withCount(['photoGalleries', 'videoGalleries', 'testimonials']);

        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }

        $categories = $query->latest()->paginate(10)->withQueryString();
        $moduleLabels = Category::moduleLabels();

        return view('admin.categories.index', compact('categories', 'moduleLabels'));
    }

    public function create()
    {
        $moduleLabels = Category::moduleLabels();

        return view('admin.categories.create', compact('moduleLabels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'module' => ['required', 'in:photo_gallery,video_gallery,testimonial'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        $moduleLabels = Category::moduleLabels();

        return view('admin.categories.edit', compact('category', 'moduleLabels'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'module' => ['required', 'in:photo_gallery,video_gallery,testimonial'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Delete related records through Eloquent (not raw DB cascade) so that
        // model events fire and any uploaded files get cleaned up via the helper.
        $category->photoGalleries()->get()->each(fn ($photo) => $photo->delete());
        $category->videoGalleries()->get()->each(fn ($video) => $video->delete());
        $category->testimonials()->get()->each(fn ($testimonial) => $testimonial->delete());

        $category->delete();

        return back()->with('success', 'Category and its related records deleted successfully.');
    }
}
