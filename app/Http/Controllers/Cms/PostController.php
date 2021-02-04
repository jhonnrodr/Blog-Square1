<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
 
        $posts = $user->posts()
                    ->select('id', 'title', 'description', 'publication_date')
                    ->orderBy('publication_date', 'desc')
                    ->paginate(10);

        return view('cms.dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // $validated = $request->validated();
        Post::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'slug'  => Str::slug($request->title, "-") .'-'. random_int(2, 1000),
                'publication_date' => now()
            ]);

        return back()->with('success', 'Your post has published successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::query()
                ->select('id', 'title', 'description', 'publication_date', 'user_id')
                ->with('author:id,name')
                ->where('slug', $slug)
                ->first();

        return view('post', compact('post'));
    }
}
