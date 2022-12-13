@extends('master')

@section('title', "List Product")

@section('content_master')

    <h1 class="text-2xl text-slate-600">List Product</h1>

    <a href="{{ route('products.create') }}" class="mt-2 font-semibold text-slate-800 hover:text-green-300 transition duration-200 ease-in-out">Tambah Product</a>

    <form action="{{ route('products.search') }}" method="POST" style="margin-top: 1rem;">
        @csrf
        <div class="w-full px-3">
            <div class="mb-5">
                <input
                type="text"
                name="keyword"
                id="keyword"
                placeholder="Search here..."
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#86efac] focus:shadow-md"
                />
            </div>
        </div>
    </form>

    @forelse ($products as $product)
        <div class="w-full max-w-md rounded bg-white shadow-xl py-10 px-4 text-gray-800 relative md:text-left mt-4">
            <div class="absolute top-4 -left-2 bg-green-400 w-[48px] h-[48px] leading-[48px] text-white font-semibold text-xs text-center rounded-full">{{ floor($product->diskon) }}% 
            </div>
            <span class="absolute left-0 top-1/2 text-xl text-green-500 font-bold tracking-[.25rem] rotate-[-90deg]">SALE</span>
            <div class="md:flex flex-col">
                <div class="w-full px-10 mb-10 md:mb-0">
                    <div class="relative">
                        <img src="{{ asset($product->foto_url) }}" class="w-full relative z-10" alt="">
                        <div class="border-4 border-yellow-200 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                    </div>
                </div>
                <div class="w-full px-10 mt-4">
                    <div class="mb-10">
                        <h1 class="font-bold uppercase text-2xl mb-5">{{ $product->nama }}</h1>
                        <p class="text-sm">
                            {!! Str::limit($product->deskripsi, 50) !!}
                        </p>
                        <a href="#" class="opacity-50 text-gray-900 hover:opacity-100 inline-block text-xs leading-none border-b border-gray-900">
                            READ MORE
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mr-5">
                            <div class="flex items-center">
                                <span class="text-2xl leading-none align-baseline">Rp. </span>
                                <span class="font-bold text-5xl leading-none align-baseline">{{ $product->diskon > 1 ? $product->harga_diskon : $product->harga }}</span>
                            </div>
                            <del>{{ $product->harga }}</del> 
                        </div>
                        <div class="flex items-center gap-4 mt-4">
                            <a href="{{ route('products.show', $product->id) }}" class="bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-6 py-2 font-semibold">
                                <i class="mdi mdi-cart -ml-2 mr-2"></i> DETAILS
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-green-400 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-6 py-2 font-semibold">
                                <i class="mdi mdi-cart -ml-2 mr-2"></i> EDIT
                            </a>
                            <a href="{{ route('products.destroy', $product->id) }}" class="bg-red-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-6 py-2 font-semibold">
                                <i class="mdi mdi-cart -ml-2 mr-2"></i> DELETE
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        @if (request()->input('keyword'))
            <h1 class="text-6xl text-center text-slate-500 my-32 font-bold">Product yang anda cari tentang "{{ request()->input('keyword') }}" tidak bisa di temukan 😌</h1>
        @else
            <h1 class="text-6xl text-center text-slate-500 my-32 font-bold">Product Sedang Kosong 😌</h1>
        @endif
    @endforelse

@endsection