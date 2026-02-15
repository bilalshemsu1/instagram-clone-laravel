<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Post</h2>
                
                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit="save" enctype="multipart/form-data">
                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Photo</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                            @if ($image)
                                <div class="mb-4">
                                    <img src="{{ $image->temporaryUrl() }}" class="max-h-96 mx-auto rounded">
                                </div>
                            @endif
                            
                            <input type="file" wire:model="image" accept="image/*" class="hidden" id="image-upload">
                            <label for="image-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded">
                                Choose Image
                            </label>
                            
                            @error('image')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                            
                            <div wire:loading wire:target="image" class="text-blue-500 mt-2">
                                Uploading...
                            </div>
                        </div>
                    </div>

                    <!-- Caption -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Caption</label>
                        <textarea wire:model="caption" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Write a caption..."></textarea>
                        @error('caption')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Location</label>
                        <input type="text" wire:model="location" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Add location">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('feed') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:opacity-90" wire:loading.attr="disabled">
                            <span wire:loading.remove>Share Post</span>
                            <span wire:loading>Sharing...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>