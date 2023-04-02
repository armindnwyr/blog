<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $categoria = Category::all();
        $post = Post::where('publish', true)
        ->when(request('category'), function($query){
            $query->whereIn('category_id', request('category'));
        })
        ->orderBy('update_at','desc')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('Welcome', compact('post','categoria'));
    }
}
