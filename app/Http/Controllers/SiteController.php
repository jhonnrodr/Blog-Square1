<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $posts = Post::query()
                ->select('id', 'title', 'description', 'user_id', 'publication_date', 'slug')
                ->with('author:id,name')
                ->latest('publication_date')
                ->paginate(10);
        return view('home', compact('posts'));
    }
}
