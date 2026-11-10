<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Resep') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('resep.update', $resep->id_resep) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="judul_resep" class="block text-sm font-medium text-gray-700">Judul Resep <span class="text-red-500">*</span></label>
                        <input type="text" name="judul_resep" id="judul_resep" value="{{ old('judul_resep', $resep->judul_resep) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        @error('judul_resep') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="instruksi_masak" class="block text-sm font-medium text-gray-700">Instruksi Masak <span class="text-red-500">*</span></label>
                        <textarea name="instruksi_masak" id="instruksi_masak" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>{{ old('instruksi_masak', $resep->instruksi_masak) }}</textarea>
                        @error('instruksi_masak') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="porsi" class="block text-sm font-medium text-gray-700">Jumlah Porsi <span class="text-red-500">*</span></label>
                        <input type="number" name="porsi" id="porsi" value="{{ old('porsi', $resep->porsi) }}" class="mt-1 block w-full md:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        @error('porsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('resep.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-300">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">Update Resep</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>