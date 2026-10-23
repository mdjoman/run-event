<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        $categories = GalleryCategory::all();
        return view('admin.gallery.index', compact('galleries', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'date' => 'required|string',
            'gallery_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gallery_image')) {
            $image = $request->file('gallery_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/gallery'), $imageName);
            $imagePath = 'uploads/gallery/' . $imageName;

            Gallery::create([
                'category' => $request->category,
                'title' => $request->title,
                'date' => $request->date,
                'image' => $imagePath,
                'status' => 0,
            ]);
        }

        return redirect()->back()->with('success', 'Image uploaded successfully! Waiting for admin approval.');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name',
        ]);

        GalleryCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->back()->with('success', 'Gallery category created successfully!');
    }

    public function storeAjax(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name',
        ]);

        $category = GalleryCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return response()->json([
            'success' => true,
            'category' => $category,
            'message' => 'Category added successfully!'
        ]);
    }

    public function approve($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->status = 1;
        $gallery->save();

        return redirect()->back()->with('success', 'Gallery image approved successfully!');
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'category' => 'required|string',
            'gallery_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $gallery->category = $request->category;

        if ($request->hasFile('gallery_image')) {
            if ($gallery->image && \Storage::disk('public')->exists($gallery->image)) {
                \Storage::disk('public')->delete($gallery->image);
            }

            $gallery->image = $request->file('gallery_image')->store('gallery', 'public');
        }

        $gallery->save();

        return back()->with('success', 'Gallery updated successfully!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if (file_exists(public_path($gallery->image))) {
            @unlink(public_path($gallery->image));
        }
        $gallery->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }

    public function categoryIndex()
    {
        $categories = GalleryCategory::latest()->get();
        return view('admin.gallery.category', compact('categories'));
    }

    public function editCategory($id)
    {
        $category = GalleryCategory::findOrFail($id);
        $categories = GalleryCategory::latest()->get();
        return view('admin.gallery.category', compact('category', 'categories'));
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:gallery_categories,name,' . $id,
        ]);

        $category = GalleryCategory::findOrFail($id);
        $oldName = $category->name;
        $newName = $request->name;
        $category->name = $newName;
        $category->slug = \Str::slug($newName);
        $category->save();

        \App\Models\Gallery::where('category', $oldName)->update([
            'category' => $newName
        ]);

        return redirect()->route('admin.gallery.category.index')->with('success', 'Category and associated galleries updated successfully!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $categories = GalleryCategory::all();

        return view('admin.gallery.edit', compact('gallery', 'categories'));
    }

    public function status($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->status = $gallery->status == 1 ? 0 : 1;
        $gallery->save();

        return back()->with('success', 'Gallery status updated successfully!');
    }

    public function destroyCategory($id)
    {
        $category = GalleryCategory::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Gallery category deleted successfully!');
    }
}
