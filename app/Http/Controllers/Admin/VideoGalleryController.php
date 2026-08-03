<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGallery::with('category')->latest()->paginate(12);

        return view('admin.video-gallery.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::where('module', Category::MODULE_VIDEO_GALLERY)
            ->where('status', 'active')->get();

        return view('admin.video-gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:500'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        VideoGallery::create($data);

        return redirect()->route('admin.video-gallery.index')->with('success', 'Video added successfully.');
    }

    public function edit(VideoGallery $videoGallery)
    {
        $categories = Category::where('module', Category::MODULE_VIDEO_GALLERY)
            ->where('status', 'active')->get();

        return view('admin.video-gallery.edit', compact('videoGallery', 'categories'));
    }

    public function update(Request $request, VideoGallery $videoGallery)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'video_url' => ['required', 'url', 'max:500'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $videoGallery->update($data);

        return redirect()->route('admin.video-gallery.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(VideoGallery $videoGallery)
    {
        // No physical file to remove here - it's just an external URL.
        $videoGallery->delete();

        return back()->with('success', 'Video deleted successfully.');
    }
}
