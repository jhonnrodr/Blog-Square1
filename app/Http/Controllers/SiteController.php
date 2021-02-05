<?php

namespace App\Http\Controllers;

use App\Jobs\AutoPostImportJob;
use App\Models\Post;
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
    public function index(Request $request): View
    {
        $order_by = $request->get('orderby', 'desc');
        $posts = Post::query()
                ->select('id', 'title', 'description', 'user_id', 'publication_date', 'slug')
                ->with('author:id,name')
                ->orderBy('publication_date', $order_by)
                ->paginate(10);
        return view('home', compact('posts', 'order_by'));
    }
}
