<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::where('user_id', auth()->user()->id)->orderBy('id','desc')->paginate(5);
        return view('admin.posts.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
        ]);

        $post = Post::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        return Redirect::route('admin.posts.edit',$post); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        // obtencion de etiquetas por ajax
        // $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {


        
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:posts,slug,'.$post->id,
            'category_id' => 'required',
            'summary' => $request->get('publish') ? 'required' : 'nullable',
            'description' => $request->get('publish') ? 'required' : 'nullable',
            'publish' => 'required',
        ]);
        
        if($request->hasFile('image')){
            $img_rp = str_replace('storage', 'public', $post->image); //buscar image almacenada
            Storage::delete($img_rp);
            
            $fileName = Str::slug($request->name).'.'.$request->image->extension();
            // $img_url = Storage::putFileAs(Storage::url('public/imagen'), $request->file('image'), $fileName);
            // $img_url2 = Storage::url($img_url);
            $imag = $request->file('image')->storeAs('public/imagen', $fileName);
            $img_url = Storage::url($imag);
            
            $post->image = $img_url;
            
            $post->save();
            // return $img_url;
        }
        
        // return $request->all();
        $post->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'summary' => $request->summary,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'publish' => $request->publish,
        ]);

        if($post->publish && is_null($post->update_at)){
            $post->update(['update_at' => now()]);
        }

        $post->tags()->sync($request->tags);

        return Redirect::route('admin.posts.index'); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return Redirect::route('admin.posts.index');

    }
}
