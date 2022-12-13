<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    
    public function show($id) {
        $product = Product::findOrfail($id);
        
        return view('products.show', compact('product'));
    }

    public function edit($id) {
        $product = Product::findOrfail($id);

        return view('products.edit', compact('product'));
    }

    public function create() {
        
        return view('products.create');
    }

    public function store(ProductFormRequest $request) {

        $request->validated();
        
        if($request->hasFile('foto')) {
            $image_path = 'storage/' . $request->file('foto')->store('images_product', 'public');
        }
        
        Product::create([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'diskon' => $request->input('diskon'),
            'harga_diskon' => ($request->input('harga') * 100) / $request->input('diskon'),
            'deskripsi' => $request->input('deskripsi'),
            'foto_name' => $request->file('foto')->getClientOriginalName(),
            'foto_url' => $image_path,
            'kondisi' => $request->input('kondisi'),
            'status' => $request->input('status'),
        ]);

        return redirect()->back()->with('success', 'Product created successfully');
    }

    public function update(ProductFormRequest $request, $id) {

        $request->validated();

        $product = Product::findOrFail($id);
        
        if($request->hasFile('foto')) {
            isset($product->foto_url) ? unlink(public_path($product->foto_url)) : false;
            $image_path = 'storage/' . $request->file('foto')->store('images_product', 'public');
        }

        $product->update([
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'foto_name' => $request->hasFile('foto') ? $request->file('foto')->getClientOriginalName() : $product->foto_name,
            'foto_url' => $request->hasFile('foto') ? $image_path : $product->foto_url
        ]);
        
        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function destroy($id) {

        $product = Product::findOrFail($id);
        
        file_exists(public_path($product->foto_url)) ? unlink(public_path($product->foto_url)) : false;
        $product->delete();
        

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function search(Request $request)
    {
        $products = Product::where([
            ['nama', '!=', Null],
            [function ($query) use ($request) {
                if (($request->input('keyword'))) {
                    $query->orWhere('nama', 'LIKE', '%' . $request->input('keyword') . '%')
                        ->get();
                }
            }]
        ])->get();

        // dd($products);

        return view('products.index', compact('products'));
    }

}
