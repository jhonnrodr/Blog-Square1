<?php

namespace App\Http\Controllers;

use App\Jobs\AutoPostImportJob;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SiteController extends Controller
{
    /**
     * Displays the home page.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     *
     *  @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request)
    {
        $order_by = $request->get('orderby', 'desc');
        $posts = app()->make(PostRepository::class)->getAll($order_by);
        return view('home', compact('posts', 'order_by'));
    }
}
