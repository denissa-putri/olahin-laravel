<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kategori</h2></x-slot>
    <div class="py-6"><div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm sm:rounded-lg">
        <form method="POST" action="{{ route('master-kategori.store') }}" class="space-y-4">
            @csrf
            <div>
                <x-input-label for="nama_kategori" value="Nama Kategori" />
                <x-text-input id="nama_kategori" name="nama_kategori" type="text" class="mt-1 block w-full" :value="old('nama_kategori')" required autofocus />
                <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
            </div>
            <div class="flex gap-2">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('master-kategori.index') }}" class="px-4 py-2 border rounded text-sm">Batal</a>
            </div>
        </form>
    </div></div>
</x-app-layout>
