@extends('layouts.app')

@section('content')
    <nav class="bg-gray-800">
        <div class="px-6">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="block sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4 cursor-pointer">
                        Blog
                    </a>
                    <a href="{{ url('/weather') }}" class="block sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4">
                        Weather
                    </a>
                    <a href="{{ url('/map') }}" class="block sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4">
                        Map
                    </a>
                    <a href="{{ url('/shop') }}" class="block sm:inline-block sm:mt-0 text-blue-200 hover:text-white mr-4">
                        Shop
                    </a>
                </div>
                <div>
                    @if(Auth::check() && Auth::user())
                        <a href="{{ route('dashboard') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white sm:mt-0 ml-4">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white sm:mt-0 ml-4">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white mt-4 sm:mt-0 ml-4">
                            Register
                        </a>
                    @endif
                </div> 
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 mt-2">
        <h1 class="text-3xl font-bold mb-4">Loo uus postitus</h1>
        <form action="{{ route('blog.store') }}" method="POST" class="max-w-lg">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Pealkiri</label>
                <input type="text" name="title" class="form-textarea rounded-md shadow-sm w-full" placeholder="Sisesta pealkiri">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Kirjeldus</label>
                <textarea name="description" class="form-textarea rounded-md shadow-sm w-full" placeholder="Sisesta kirjeldus"></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Loo postitus</button>
        </form>
    </div>
@endsection

