@extends('layouts_user.index')

@section('title', 'Login')

@section('content_master')

    @if (session()->get('success'))
        <p class="text-green text-xs italic">{{ session()->get('success') }}</p>
    @endif

    @if ( $errors->any() )
        <h1 class="text-red italic" style="background-color: lightcoral; color: white; padding: 10px; border-radius: 10px; width: 100%; margin-bottom: 10px; font-size: 1rem">{{ $errors->first() }}</h1>
    @endif

    <form action="{{ route('login') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
        @csrf
        <div class="mb-4">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
            Email
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="email" name="email" type="text" placeholder="Email..">
        </div>
        <div class="mb-6">
        <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
            Password
        </label>
        <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" type="password" name="password" placeholder="******************">
        </div>
        <div class="flex items-center justify-between">
        <button type="submit" class="bg-red hover:bg-blue-dark text-white font-bold py-2 px-4 rounded" style="background-color: lightskyblue;">
            Sign In
        </button>
        </div>
    </form>
@endsection