<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * CRUD
     * list - index
     * detail - show
     * edit - update
     * create - store
     * delete - destroy
    */

    public function index()
    {
        $blog = Blog::query()->get();

        return response()->json([
            "status" => true,
            "message" => "Successfully get data from api",
            "data" => $blog
        ]);
    }

    public function show($id)
    {
        $blog = Blog::query()
                    ->where('id', $id)
                    ->first();

        if($blog == null) {
            return response()->json([
                "status" => false,
                "message" => "User not found",
                "data" => null,
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Successfully get data from api",
            "data" => $blog
        ]);   
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'author_name' => 'required'
        ], [
            'title.required' => 'Input title harus di isi',
            'body.required' => 'Input body harus di isi',
            'author_name.required' => 'Input author harus di isi'
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->all(),
                "data" => null
            ]);
        }
                
        if($request->hasFile('thumbnail')) {
            $image_path = 'storage/' . $request->file('thumbnail')->store('images_blog', 'public');
        }


        // if(!isset($payload['title'])) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "wajib ada title",
        //         "data" => null
        //     ]);   
        // }
        
        // if(!isset($payload['body'])) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "wajib ada content",
        //         "data" => null
        //     ]);   
        // }
        
        // if(!isset($payload['author_name'])) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => "wajib ada author name",
        //         "data" => null
        //     ]);   
        // }
        
        $payload['thumbnail'] = $request->file('thumbnail')->getClientOriginalName();
        $payload['thumbnail_path'] = $image_path;

        $blog = Blog::query()->create($payload);
        
        return response()->json([
            "status" => true,
            "message" => "Berhasil membuat product",
            "data" => $blog->makeHidden([
                'id',
                'created_at',
                'updated_at'
             ])
        ]);   
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();

        $blog = Blog::query()->findOrFail($id);
        // dd($blog);

        if($blog == null) {
            return response()->json([
                'status' => false,
                'message' => 'Post not found',
                'data' => null
            ]);
        }
        
        if($request->hasFile('foto')) {
            isset($blog->thumbnail_path) ? unlink(public_path($blog->thumbnail_path)) : false;
            $image_path = 'storage/' . $request->file('thumbnail')->store('images_blog', 'public');
        }

        $payload['thumbnail'] = $request->hasFile('foto') ? $request->file('thumbnail')->getClientOriginalName() : $blog->thumbnail;
        $payload['thumbnail_path'] = $request->hasFile('thumbnail') ? $image_path : $blog->thumbnail_path;

        $blog->update($payload);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated post',
            'data' => $blog->makeHidden([
               'id',
               'created_at',
               'updated_at'
            ])
        ]);
    }

    public function destroy($id)
    {
        $blog = Blog::query()->where('id', $id)->first();
        if($blog == null) {
            return response()->json([
                "status" => false,
                "message" => "Post not found",
                "data" => null
            ]);
        }

        file_exists(public_path($blog->thumbnail_path)) ? unlink(public_path($blog->thumbnail_path)) : false;
        $blog->delete();

        return response()->json([
            "status" => true,
            "message" => "Post berhasil dihapus",
            "data" => null
        ]);
    }

}
