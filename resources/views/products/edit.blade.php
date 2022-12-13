@extends('layouts_user.index')

@section('title', "Edit Product {{ $product->nama }}")

@section('content_master')

<a href="{{ route('homepage') }}" class="mt-2 font-semibold text-slate-800 hover:text-green-300 transition duration-200 ease-in-out">Kembali</a>

<div class="relative block p-8 mt-8 overflow-hidden border bg-white border-slate-100 rounded-lg">

    @if (session()->has('success'))
        <div class="bg-green-500 text-white font-bold rounded py-2 px-4 mb-4">
            {{ session()->get('success') }}
        </div>
    @endif


    @if($errors->any())
        <div class="mb-4">
            <div class="bg-red-500 text-white font-bold rounded-t py-2 px-4">
                Something went wrong...
            </div>
            <ul class="border border-t-0 border-red-400 rounded-b px-4 py-3 text-red-700">
                @foreach($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PATCH')
        <div class="-mx-3 flex flex-wrap">
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label
                    for="nama"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                    Nama
                    </label>
                    <input
                    type="text"
                    name="nama"
                    id="nama"
                    placeholder="Nama..."
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md"
                    value="{{ $product->nama }}"
                    />
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label
                    for="harga"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                    Harga
                    </label>
                    <input
                    type="text"
                    name="harga"
                    id="harga"
                    placeholder="Harga..."
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md"
                    value="{{ $product->harga }}"
                    />
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label
                    for="diskon"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                    Diskon
                    </label>
                    <input
                    type="number"
                    name="diskon"
                    id="diskon"
                    placeholder="Diskon..."
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md"
                    value="{{ floor($product->diskon) }}"
                    />
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label
                    for="status"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                    Kondisi
                    </label>
                    <select name="kondisi" id="kondisi" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md">
                        <option value="0" {{ $product->kondisi == 0 ? 'selected' : '' }}>New</option>
                        <option value="1" {{ $product->kondisi == 1 ? 'selected' : '' }}>Second</option>
                    </select>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label
                    for="status"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                    Status
                    </label>
                    <select name="status" id="status" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md">
                        <option value="1">In Stock</option>
                        <option value="0">Out of Stock</option>
                    </select>
                </div>
            </div>
            <div class="w-full px-3 sm:w-1/2">
                <div class="mb-5">
                    <label
                    for="foto"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                        Foto
                    </label>
                    <input
                    type="file"
                    name="foto"
                    id="foto"
                    placeholder="Foto..."
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md"
                    />
                </div>
            </div>
            <div class="w-full px-3">
                <div class="mb-5">
                    <label
                    for="deskripsi"
                    class="mb-3 block text-base font-medium text-[#07074D]"
                    >
                    Deskripsi
                    </label>
                    <textarea name="deskripsi" id="" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md" cols="30" rows="5" placeholder="Description...">{{ $product->deskripsi }}</textarea>
                </div>
            </div>

            <div class="w-full px-3">
                <button
                    type="submit"
                    class="hover:shadow-form rounded-md bg-green-400 py-3 px-8 text-center text-base font-semibold text-white outline-none"
                >
                    Update Product
                </button>
            </div>

        </div>
    </form>    

@endsection