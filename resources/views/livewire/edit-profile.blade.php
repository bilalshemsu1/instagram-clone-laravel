<div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>
                
                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('message') }}
                    </div>
                @endif

                <form wire:submit="save" enctype="multipart/form-data">
                    <!-- Profile Photo -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">Profile Photo</label>
                        <div class="flex items-center space-x-6">
                            <div class="w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full p-1">
                                <div class="w-full h-full bg-gray-200 rounded-full overflow-hidden">
                                    @if($profile_photo)
                                        <img src="{{ $profile_photo->temporaryUrl() }}" class="w-full h-full object-cover">
                                    @elseif($currentPhoto)
                                        <img src="{{ $currentPhoto }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                                            <span class="text-2xl font-bold text-gray-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <input type="file" wire:model="profile_photo" accept="image/*" class="hidden" id="photo-upload">
                                <label for="photo-upload" class="cursor-pointer bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded">
                                    Choose Photo
                                </label>
                                <div wire:loading wire:target="profile_photo" class="text-blue-500 text-sm mt-1">
                                    Uploading...
                                </div>
                                @error('profile_photo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Name</label>
                        <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Username</label>
                        <input type="text" wire:model="username" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div wire:loading wire:target="updatedUsername" class="text-blue-500 text-sm mt-1">
                            Checking availability...
                        </div>
                    </div>

                    <!-- Email (read-only) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" wire:model="email" disabled class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-600">
                        <p class="text-gray-500 text-xs mt-1">Email cannot be changed</p>
                    </div>

                    <!-- Bio -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Bio</label>
                        <textarea wire:model="bio" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600" placeholder="Tell us about yourself..."></textarea>
                        @error('bio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">{{ strlen($bio ?? '') }}/500 characters</p>
                    </div>

                    <hr class="my-6">

                    <h3 class="text-xl font-bold text-gray-800 mb-4">Change Password (Optional)</h3>

                    <!-- Current Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Current Password</label>
                        <input type="password" wire:model="current_password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">New Password</label>
                        <input type="password" wire:model="new_password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                        @error('new_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Confirm New Password</label>
                        <input type="password" wire:model="new_password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end space-x-4 mt-6">
                        <a href="{{ route('profile') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:opacity-90" wire:loading.attr="disabled">
                            <span wire:loading.remove>Save Changes</span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>