<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;




class PostController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('blog.index', compact('posts'));
    }


    public function create()
    {
        return view('blog.createPost');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $slug = Str::slug($validatedData['title'], '-');

        $newImageName = uniqid() . '-' . $slug . '.' . $validatedData['image']->extension();

        $validatedData['image']->move(public_path('images'), $newImageName);

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $newImageName,
            'slug' => $slug,
            'user_id' => auth()->user()->id
        ]);

        return redirect('/blog')->with('message', 'Your post has been added!');
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('blog.showPost', ['post' => $post]);
    }



    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('blog.editPost', ['post' => $post]);
    }


    public function update(Request $request, $slug)
    {
        
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        
        $post = Post::where('slug', $slug)->first();

        if ($post) {
            
            if ($request->hasFile('image')) {
                $newSlug = Str::slug($validatedData['title'], '-');
                $newImageName = uniqid() . '-' . $newSlug . '.' . $validatedData['image']->extension();
                $validatedData['image']->move(public_path('images'), $newImageName);
                $post->image = $newImageName;  
            }

           
            $post->title = $request->input('title');
            $post->content = $request->input('content');

           
            if ($post) {
                $baseSlug = Str::slug($request->input('title'), '-');
                $uniqueSlug = $baseSlug;

                
                if (Post::where('slug', $uniqueSlug)->exists() && $uniqueSlug != $post->slug) {
                    $uniqueSlug = $baseSlug . '-' . $post->id;  
                }

                $post->slug = $uniqueSlug;  
            }

            $post->save();

            
            return redirect('blog/' . $post->slug)->with('message', 'Your post has been updated!');
        }

        return redirect('blog')->withErrors('Post not found');
    }



    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $post->delete();
        return redirect('/blog')->with('message', 'Your post has been deleted!');
    }
}
