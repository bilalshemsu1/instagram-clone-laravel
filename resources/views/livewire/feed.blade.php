<div class="min-h-screen bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left: Logo -->
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Instagram
                    </h1>
                </div>

                <!-- Center: Navigation Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('feed') }}" class="text-gray-800 hover:text-purple-600 font-semibold">
                        Home
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800">
                        Search
                    </a>
                    <a href="#" class="text-gray-600 hover:text-gray-800">
                        Explore
                    </a>
                </div>

                <!-- Right: Actions -->
                <div class="flex items-center space-x-4">
                    <a href="/create-post">
                        <button  class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </a>
                    <a href="{{ route('profile') }}" class="text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-red-500 text-sm font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Feed Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Left Sidebar (Optional) -->
            <div class="hidden md:block md:col-span-1">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Suggestions</h3>
                    <p class="text-gray-600 text-sm">Suggestions will appear here</p>
                </div>
            </div>

            <!-- Center Feed -->
            <div class="md:col-span-2">
                <div class="space-y-6">
                    @foreach($posts as $post)
                        <!-- Post Placeholder 1 -->
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{$post->user->name}}</h4>
                                        <p class="text-sm text-gray-500">{{$post->location}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-200 h-96 flex items-center justify-center">
                                <img src="{{ $post->image_path }}" alt="Post image" class="w-full h-96 object-cover">
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex space-x-4">
                                        <button wire:click="toggleLike({{ $post->id }})" 
                                                class="text-gray-600 hover:text-red-500 {{ $post->isLikedBy(auth()->id()) ? 'text-red-500' : '' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="{{ $post->isLikedBy(auth()->id()) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                        <button class="text-gray-600 hover:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                        </button>
                                        <button class="text-gray-600 hover:text-yellow-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                        </button>
                                    </div>
                                    <button class="text-gray-600 hover:text-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="font-semibold text-gray-800 mb-1">{{ $post->likes_count }} {{ Str::plural('like', $post->likes_count) }}</p>
                                <p class="text-gray-800">
                                    <span class="font-semibold">{{$post->user->name}}</span>
                                    <span class="text-gray-600"> {{$post->caption}}</span>
                                </p>
                                <p class="font-semibold text-gray-800 mb-1">{{ $post->likes_count }} {{ Str::plural('like', $post->likes_count) }}</p>
                                <p class="text-gray-600 text-sm mb-2">{{ $post->comments_count }} {{ Str::plural('comment', $post->comments_count) }}</p>
                                
                                <!-- Comments Display Area (ADD THIS NEW SECTION ABOVE) -->
                                <div class="mt-3">
                                    @if($post->comments->count() > 0)
                                        <div class="space-y-2 mb-3 max-h-40 overflow-y-auto">
                                            @foreach($post->comments->take(3) as $comment)
                                                <div class="flex justify-between items-start">
                                                    <p class="text-sm">
                                                        <span class="font-semibold">{{ $comment->user->name }}:</span>
                                                        <span class="text-gray-700">{{ $comment->content }}</span>
                                                    </p>
                                                    @if($comment->user_id === auth()->id())
                                                        <button wire:click="deleteComment({{ $comment->id }})" class="text-xs text-red-500 hover:text-red-700 ml-2">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </div>
                                            @endforeach
                                            
                                            @if($post->comments->count() > 3)
                                                <button class="text-sm text-gray-500 hover:text-gray-700">
                                                    View all {{ $post->comments_count }} comments
                                                </button>
                                            @endif
                                        </div>
                                    @else
                                        <p class="text-gray-500 text-sm mb-3">No comments yet. Be the first to comment!</p>
                                    @endif

                                    <!-- Comment Form (UPDATE THIS) -->
                                    <div class="flex items-center border-t border-gray-200 pt-3">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full mr-3 flex-shrink-0"></div>
                                        <form wire:submit.prevent="addComment({{ $post->id }})" class="flex-1 flex">
                                            <input type="text" 
                                                wire:model="newComments.{{ $post->id }}" 
                                                placeholder="Add a comment..." 
                                                class="flex-1 bg-transparent focus:outline-none text-gray-700 text-sm">
                                            <button type="submit" 
                                                    class="text-blue-500 font-semibold text-sm hover:text-blue-700"
                                                    wire:loading.attr="disabled">
                                                <span wire:loading.remove>Post</span>
                                                <span wire:loading>...</span>
                                            </button>
                                        </form>
                                    </div>
                                    @error("newComments.{$post->id}") 
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>