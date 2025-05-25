<section>
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" 
                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500" 
                   value="{{ old('name', $user->name) }}" 
                   required autofocus autocomplete="name" />
            @error('name')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" 
                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500" 
                   value="{{ old('email', $user->email) }}" 
                   required autocomplete="username" />
            @error('email')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="px-4 py-2 bg-amber-500 text-gray-900 rounded-lg font-medium hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-amber-500 transition-colors duration-200">
                {{ __('Save Changes') }}
            </button>
        </div>
    </form>
</section>
