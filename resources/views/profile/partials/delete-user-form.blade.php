<section>
    <p class="text-sm text-gray-400 mb-4">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>

    <button type="button" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-red-500 transition-colors duration-200"
        onclick="document.getElementById('delete-account-modal').classList.remove('hidden')">
        {{ __('Delete Account') }}
    </button>

    <!-- Delete Account Modal -->
    <div id="delete-account-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative p-6 mx-auto max-w-md bg-gray-800 rounded-xl shadow-xl">
            <div class="absolute top-3 right-3">
                <button type="button" class="text-gray-400 hover:text-gray-200" onclick="document.getElementById('delete-account-modal').classList.add('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <h3 class="text-xl font-bold text-red-400 mb-4">{{ __('Delete Account') }}</h3>
            
            <p class="text-sm text-gray-300 mb-6">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">{{ __('Password') }}</label>
                    <input id="password" name="password" type="password" 
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500" 
                           placeholder="{{ __('Enter your password') }}" />
                    @error('password', 'userDeletion')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" class="px-4 py-2 bg-gray-700 text-gray-300 rounded-lg font-medium hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-gray-500 transition-colors duration-200"
                            onclick="document.getElementById('delete-account-modal').classList.add('hidden')">
                        {{ __('Cancel') }}
                    </button>
                    
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-red-500 transition-colors duration-200">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
