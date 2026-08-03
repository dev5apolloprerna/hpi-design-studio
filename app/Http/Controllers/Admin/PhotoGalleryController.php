<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $photos = PhotoGallery::with('category')->latest()->paginate(12);

        return view('admin.photo-gallery.index', compact('photos'));
    }

    public function create()
    {
        $categories = Category::where('module', Category::MODULE_PHOTO_GALLERY)
            ->where('status', 'active')->get();

        return view('admin.photo-gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        // Store the uploaded photo via the reusable upload helper.
        $data['image'] = upload_file($request->file('image'), 'photo-gallery');

        PhotoGallery::create($data);

        return redirect()->route('admin.photo-gallery.index')->with('success', 'Photo added successfully.');
    }

    public function edit(PhotoGallery $photoGallery)
    {
        $categories = Category::where('module', Category::MODULE_PHOTO_GALLERY)
            ->where('status', 'active')->get();

        return view('admin.photo-gallery.edit', compact('photoGallery', 'categories'));
    }

    public function update(Request $request, PhotoGallery $photoGallery)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $photoGallery->image;
            $data['image'] = upload_file($request->file('image'), 'photo-gallery');
            delete_uploaded_file($oldImage);
        }

        $photoGallery->update($data);

        return redirect()->route('admin.photo-gallery.index')->with('success', 'Photo updated successfully.');
    }

    public function destroy(PhotoGallery $photoGallery)
    {
        // The model's booted() "deleting" event removes the physical file.
        $photoGallery->delete();

        return back()->with('success', 'Photo deleted successfully.');
    }
}
