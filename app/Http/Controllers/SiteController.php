<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $posts = Post::query()
                ->with('author')
                ->get();
        return view('home', compact('posts'));
    }
}
