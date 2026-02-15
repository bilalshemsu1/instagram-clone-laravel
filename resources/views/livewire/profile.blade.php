<div class="min-h-screen bg-gray-100">
    <!-- Navigation Bar (same as feed) -->
    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left: Logo -->
                <div class="flex items-center">
                    <a href="{{ route('feed') }}">
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Instagram
                        </h1>
                    </a>
                </div>

                <!-- Center: Navigation Links -->
                <div class="flex items-center space-x-8">
                    <a href="{{ route('feed') }}" class="text-gray-600 hover:text-purple-600">
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
                    <a href="{{ route('create-post') }}">
                        <button class="text-gray-600 hover:text-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </button>
                    </a>
                    <a href="{{ route('profile') }}" class="text-gray-800 hover:text-purple-600">
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

    <!-- Profile Header -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
                <!-- Profile Picture -->
                <div class="w-32 h-32 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full p-1">
                    <div class="w-full h-full bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                        @if($user->profile_picture)
                            <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-3xl font-bold text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                        @endif
                    </div>
                </div>

                <!-- Profile Info -->
                <div class="flex-1 text-center md:text-left">
                    <div class="flex flex-col md:flex-row items-center md:items-center space-y-2 md:space-y-0 md:space-x-4 mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                        @if($isOwnProfile)
                            <a href="{{ route('edit-profile') }}">
                                <button class="px-4 py-1 bg-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-300">
                                    Edit Profile
                                </button>
                            </a>
                        @else
                            <livewire:follow-button :userId="$user->id" wire:key="follow-{{ $user->id }}" />
                        @endif
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-center md:justify-start space-x-8 mb-4">
                        <div class="text-center">
                            <span class="font-bold text-gray-800">{{ $postsCount }}</span>
                            <span class="text-gray-600 ml-1">posts</span>
                        </div>
                        <div class="text-center">
                            <span class="font-bold text-gray-800">{{ $followersCount }}</span>
                            <span class="text-gray-600 ml-1">followers</span>
                        </div>
                        <div class="text-center">
                            <span class="font-bold text-gray-800">{{ $followingCount }}</span>
                            <span class="text-gray-600 ml-1">following</span>
                        </div>
                    </div>

                    <!-- Bio -->
                    @if($user->bio ?? false)
                        <p class="text-gray-800">{{ $user->bio }}</p>
                    @else
                        <p class="text-gray-400 italic">No bio yet</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="mt-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Posts</h3>
            
            @if($posts->isEmpty())
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <p class="text-gray-500">No posts yet</p>
                    @if($isOwnProfile)
                        <a href="{{ route('create-post') }}" class="inline-block mt-4 px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:opacity-90">
                            Create your first post
                        </a>
                    @endif
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($posts as $post)
                        <div class="bg-white rounded-lg shadow overflow-hidden group cursor-pointer relative">
                            <img src="{{ $post->image_path }}" alt="Post" class="w-full h-64 object-cover group-hover:opacity-80 transition">
                            
                            <!-- Hover Overlay with Stats -->
                            <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center space-x-8 text-white">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span>{{ $post->likes_count }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>{{ $post->comments_count }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('followUpdated', () => {
            // Optional: Show a small notification
            console.log('Follow status updated');
        });
    });
</script>
@endpush