<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $post = Post::where('publish', true)
        ->orderBy('update_at','desc')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('Welcome', compact('post'));
    }
}
