<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{

    /**
     * @var \App\Repositories\PostRepository
     */
    private $postRepository;

    /**
     * PostController constructor.
     *
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->middleware('auth', ['except'=>'show']);
        $this->postRepository = $postRepository;
    }

    /**
     * Displays the manage posts page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->postRepository->getByAuthor(Auth::user());

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
        $this->postRepository->create($request);

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
        $post = $this->postRepository->findBySlug($slug);
        
        return view('post', compact('post'));
    }
}
