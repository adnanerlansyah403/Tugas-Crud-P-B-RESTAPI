<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{

    public function index() 
    {
        $blogs = Blog::query()->get();

        // dd($blogs);

        return view('blogs.index', compact('blogs'));
    }
    
    public function show(Blog $blog) {
        
        // dd($blog);
        return view('blogs.show', compact('blog'));
    }

    public function create() {
        
        return view('blogs.create');
    }

    public function store(BlogFormRequest $request) {

        $request->validated();

        // dd(Str::of($request->input('title'))->slug('-'));

        if($request->hasFile('thumbnail')) {
            $image_path = 'storage/' . $request->file('thumbnail')->store('images_blog', 'public');
        }
        
        Blog::create([
            'title' => $request->input('title'),
            'slug' => Str::of($request->input('title'))->slug('-'),
            'category' => $request->input('category'),
            'author_name' => $request->input('author_name'),
            'body' => $request->input('body'),
            'thumbnail' => $request->file('thumbnail')->getClientOriginalName(),
            'thumbnail_path' => $image_path
        ]);

        return redirect()->back()->with('success', 'Blog created successfully');
    }

    public function update(BlogFormRequest $request, Blog $blog) {

        $request->validated();

        // dd($blog);

        if($request->hasFile('thumbnail')) {
            isset($blog->thumbnail_path) ? unlink(public_path($blog->thumbnail_path)) : false;
            $image_path = 'storage/' . $request->file('thumbnail')->store('images_blog', 'public');
        }

        $blog->update([
            'title' => $request->input('title'),
            'slug' => Str::of($request->input('title'))->slug('-'),
            'category' => $request->input('category'),
            'author_name' => $request->input('author_name'),
            'thumbnail' => $request->hasFile('thumbnail') ? $request->file('thumbnail')->getClientOriginalName() : $blog->thumbnail,
            'thumbnail_path' => $request->hasFile('thumbnail') ? $image_path : $blog->thumbnail_path
        ]);
        
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog) {

        file_exists(public_path($blog->thumbnail_path)) ? unlink(public_path($blog->thumbnail_path)) : false;
        
        $blog->delete();
        
        return redirect()->back()->with('success', 'Blog deleted successfully');
    }

}
