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
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-blue-500 hover:bg-white sm:mt-0 ml-4">
                        Log out
                        </button>
                        </form>
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
    <div class="container mx-auto p-6 mt-2">
        <h1 class="text-3xl font-bold my-4">Blogi postitused</h1>
        @if(Auth::user() && Auth::user()->is_admin)
            <a href="{{ route('blog.create') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mb-4">Loo uus postitus</a>
        @endif
        <hr class="mb-4">
        @foreach($blogs as $blog)
            <div class="bg-white shadow-md rounded px-8 p-4 pt-6 pb-8 mb-4 max-w-lg">
                <h4 class="font-bold text-xl mb-2">{{ $blog->title }}</h4>
                <p class="text-gray-700 text-base">{{ $blog->description }}</p>
                @if(Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('blog.edit', $blog->id) }}" class="bg-yellow-500 hover:bg-yellow-700 font-bold py-2 px-4 rounded mt-4 inline-block">Redigeeri</a>
                @endif
                <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-4 inline-block" onclick="toggleComments({{ $blog->id }})">Näita kommentaare</button>
                <div id="comments{{ $blog->id }}" class="hidden mt-4">
                    <h3 class="font-bold mb-2">Kommentaarid:</h3>
                    <ul>
                        @foreach($blog->comments as $comment)
                            <li class="border rounded p-6 mb-2" style="word-wrap: break-word;">
                                {{ $comment->text }} 
                                @if($comment->user)
                                    (by {{ $comment->user->name }})
                                    <span class="text-sm text-gray-500 float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                    @if(Auth::check() && Auth::user()->is_admin)
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Kustuta</button>
                                        </form>
                                    @elseif(Auth::check() && $comment->user_id == Auth::user()->id)
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Kustuta</button>
                                        </form>
                                    @endif
                                @else
                                    (by Anonymous at {{ $comment->created_at }})
                                    <span class="text-sm text-gray-500 float-right">{{ $comment->created_at->diffForHumans() }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <h3 class="font-bold mb-2 mt-4">Lisa kommentaar:</h3>
                    <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                        @csrf
                        <textarea name="text" class="w-full rounded-lg p-2" placeholder="Kommentaari sisu"></textarea>
                        <br>
                        <input type="hidden" name="user_id" value="{{ Auth::check() ? Auth::user()->id : null }}">
                        <!-- Set a default value of null for the user_id field -->
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded mt-2">Saada</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        function toggleComments(blogId) {
            var commentsDiv = document.getElementById("comments" + blogId);
            if (commentsDiv.classList.contains("hidden")) {
                commentsDiv.classList.remove("hidden");
            } else {
                commentsDiv.classList.add("hidden");
            }
        }

        defineProps({
            canLogin: {
                type: Boolean,
            },
            canRegister: {
                type: Boolean,
            },
            laravelVersion: {
                type: String,
                required: true,
            },
            phpVersion: {
                type: String,
                required: true,
            },
        });
    </script>
@endsection

