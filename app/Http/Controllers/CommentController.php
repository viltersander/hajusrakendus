<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create($request->validate([
            'blog_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]));

        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}

