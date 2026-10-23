<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->is_approved = !($blog->is_approved ?? false);
        $blog->save();

        return back()->with('success', 'Blog approval status updated successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'required|string',
        ]);

        $blog->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return back()->with('success', 'Blog deleted successfully.');
    }
}
