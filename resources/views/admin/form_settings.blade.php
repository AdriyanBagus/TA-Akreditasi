<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Pengaturan Form User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700 text-left">
                            <th class="px-6 py-3 border">Nama Form</th>
                            <th class="px-6 py-3 border text-center">Pilih User</th>
                            <th class="px-6 py-3 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($forms as $form)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 border">{{ $form->form_name }}</td>
                                
                                <td class="px-6 py-4 border text-left">
                                    <form action="{{ route('form.settings.update', $form->id) }}" method="POST">
                                        @csrf
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach ($users as $user)
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                                        {{ in_array($user->id, $selectedUsers[$form->id] ?? []) ? 'checked' : '' }}>
                                                    <span>{{ $user->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                </td>
                                <td class="px-6 py-4 border text-center">
                                        {{-- Sembunyikan dropdown, tetap kirim status --}}
                                        <input type="hidden" name="status" value="{{ $form->status }}">
                                        
                                        <button type="submit"
                                            class="mt-2 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                            Simpan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
