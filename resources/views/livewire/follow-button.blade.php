<div>
    @auth
        @if(Auth::id() !== $userId)
            <button wire:click="toggleFollow" 
                    class="px-4 py-1 text-sm font-semibold rounded-lg transition
                    {{ $isFollowing 
                        ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' 
                        : 'bg-blue-500 text-white hover:bg-blue-600' }}">
                {{ $isFollowing ? 'Following' : 'Follow' }}
            </button>
        @endif
    @endauth
</div>