<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        $product = Product::query()->get();

        return response()->json([
            "status" => true,
            "message" => "Successfully get data from api",
            "data" => $product
        ]);
    }

    public function show($id)
    {
        $product = Product::query()
                    ->where('id', $id)
                    ->first();

        // dd($product);

        if($product == null) {
            return response()->json([
                "status" => false,
                "message" => "Product not found",
                "data" => null,
            ]);
        }

        return response()->json([
            "status" => true,
            "message" => "Successfully get data from api",
            "data" => $product
        ]);   
    }

    public function store(Request $request)
    {
        $payload = $request->all();
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'harga' => 'required',
            'diskon' => 'nullable|max:100',
            'deskripsi' => 'required',
            'foto' => 'required',
        ], [
            'nama.required' => 'Input nama harus di isi',
            'harga.required' => 'Input harga harus di isi',
            'diskon.max' => 'Input diskon tidak boleh lebih dari 100',
            'deskripsi.required' => 'Input deskripsi harus di isi',
            'foto.required' => 'Input foto harus di isi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->all(),
                "data" => null
            ]);
        }
                
        if($request->hasFile('foto')) {
            $image_path = 'storage/' . $request->file('foto')->store('images_product', 'public');
        }

        $payload['harga_diskon'] = ($payload['harga'] * 100) / $payload['diskon'];
        $payload['foto_name'] = $request->file('foto')->getClientOriginalName();
        $payload['foto_url'] = $image_path;
        

        $product = Product::query()->create($payload);
        
        return response()->json([
            "status" => true,
            "message" => "Berhasil Membuat Product",
            "data" => $product->makeHidden([
                'id',
                'created_at',
                'updated_at'
             ])
        ]);   
    }

    public function update(Request $request, $id)
    {
        $payload = $request->all();

        $product = Product::query()->findOrFail($id);
        // dd($product);

        if($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found',
                'data' => null
            ]);
        }
        
        if($request->hasFile('foto')) {
            isset($product->foto_url) ? unlink(public_path($product->foto_url)) : false;
            $image_path = 'storage/' . $request->file('foto')->store('images_product', 'public');
        }

        $payload['harga_diskon'] = isset($payload['diskon']) ? ($payload['harga'] * 100) / $payload['diskon'] : 0;
        $payload['foto_name'] = $request->hasFile('foto') ? $request->file('foto')->getClientOriginalName() : $product->foto_name;
        $payload['foto_url'] = $request->hasFile('foto') ? $image_path : $product->foto_url;

        $product->update($payload);

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated Product',
            'data' => $product->makeHidden([
               'id',
               'created_at',
               'updated_at'
            ])
        ]);
    }

    public function destroy($id)
    {
        $product = Product::query()->where('id', $id)->first();
        if($product == null) {
            return response()->json([
                "status" => false,
                "message" => "Product not found",
                "data" => null
            ]);
        }

        file_exists(public_path($product->foto_url)) ? unlink(public_path($product->foto_url)) : false;
        $product->delete();

        return response()->json([
            "status" => true,
            "message" => "Product berhasil dihapus",
            "data" => null
        ]);
    }

}
