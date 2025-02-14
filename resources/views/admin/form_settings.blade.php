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
                            <th class="px-6 py-3 border text-center">Status</th>
                            <th class="px-6 py-3 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($forms as $form)
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 border">{{ $form->form_name }}</td>
                                <td class="px-6 py-4 border text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        {{ $form->status ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ $form->status ? 'ON' : 'OFF' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 border text-center">
                                    <form action="{{ route('admin.forms.update', $form->id) }}" method="POST" class="inline-flex items-center space-x-2">
                                        @csrf
                                        <select name="status" class="px-4.5 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
                                            <option value="1" {{ $form->status ? 'selected' : '' }}>ON</option>
                                            <option value="0" {{ !$form->status ? 'selected' : '' }}>OFF</option>
                                        </select>
                                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
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
