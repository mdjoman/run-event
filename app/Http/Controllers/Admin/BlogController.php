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
        return view('admin.blogs.index', compact('blogs'));
    }

    public function approve($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update(['is_approved' => 1]);

        return back()->with('success', 'Blog approved successfully and now visible on frontend!');
    }

    // Blog delete korar jonno
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        // Image delete code (optional)
        $blog->delete();

        return back()->with('success', 'Blog deleted successfully.');
    }
}
