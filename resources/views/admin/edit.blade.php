<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow rounded-lg p-8">
                <form method="POST" action="{{ route('admin.update-user', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nama User')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
                    </div>

                    <!-- Role -->
                    <input type="hidden" name="usertype" value="user">

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
