<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        
        return view('blog.index', ['blogs' => $blogs]);
        // return Inertia::render('Blog/Index', [
        //     'blogs' => $blogs,
        // ]);
    }

    public function create()
    {
        return view('blog.create');
        // return Inertia::render('Blog/Create', [
            
        // ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|unique:blogs|max:255',
            'description' => 'required',
        ]);

        $blogs = Blog::create($validated);

        return redirect('/blog')->with('success', 'Blog created successfully!');
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        $user = Auth::user();
        return view('blog.show', ['blog' => $blog, 'user' => $user]);
        // return Inertia::render('Blog/Show', [
        //     'blog' => $blog,
        //     'user' => $user
        // ]);
    }

    public function edit($id)
    {
        $blog = Blog::find($id);

        return view('blog.edit', ['blog' => $blog]);
        // return Inertia::render('Blog/Edit', [
        //     'blog' => $blog,
        // ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|unique:blogs,title,'.$id.',id|max:255',
            'description' => 'required',
        ]);
        
        $blog = Blog::find($id);
        $blog->update($validated);
        $blog->title = $validated['title'];
        $blog->description = $validated['description'];
        $blog->save();

        return redirect('/blog')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        return redirect('/blog')->with('success', 'Blog deleted successfully!');
    }

    public function showComment($id)
    {
        $blog = Blog::find($id);
        $comments = Comment::where('blog_id', $id)->get();

        return view('blog.show', ['blog' => $blog, 'comments' => $comments]);
        // return Inertia::render('Blog/Index', [
        //     'blog' => $blog,
        //     'comments' => $comments
        // ]);
    }

    public function storeComment(Request $request, $id)
    {
        $validated = $request->validate([
            'text' => 'required',
        ]);

        $comment = new Comment;
        $comment->text = $request->input('text');
        $comment->blog_id = $id;

         if (Auth::check()) { // check if user is authenticated
            $comment->user_id = Auth::user()->id;
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to add a comment');
        }
    
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }


    public function destroyComment($id)
    {
        $comment = Comment::find($id);
        
        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found!');
        }
        
        // Allow only the admin to delete comments created by any user
        if (Auth::user()->is_admin || $comment->user_id === Auth::user()->id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment!');
        }
    }

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'storeComment', 'destroyComment']);
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
}



