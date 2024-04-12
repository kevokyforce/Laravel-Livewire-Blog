<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('home', [
            'featuredPosts' => Post::featured()->published()->latest('published')->take(3)->get(),
            'latestPosts' => Post::published()->latest('published')->take(9)->get(),
        ]);
    }
}
