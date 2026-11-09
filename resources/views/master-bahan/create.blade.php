<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Bahan</h2></x-slot>
    <div class="py-6"><div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm sm:rounded-lg">
        <form method="POST" action="{{ route('master-bahan.store') }}" class="space-y-4">
            @csrf
            <div>
                <x-input-label for="id_kategori" value="Kategori" />
                <select id="id_kategori" name="id_kategori" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">-- pilih kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}" @selected(old('id_kategori')==$k->id_kategori)>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('id_kategori')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="nama_bahan" value="Nama Bahan" />
                <x-text-input id="nama_bahan" name="nama_bahan" type="text" class="mt-1 block w-full" :value="old('nama_bahan')" required />
                <x-input-error :messages="$errors->get('nama_bahan')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="satuan_terkecil" value="Satuan Terkecil (kg, gr, pcs, ikat)" />
                <x-text-input id="satuan_terkecil" name="satuan_terkecil" type="text" class="mt-1 block w-full" :value="old('satuan_terkecil')" required />
                <x-input-error :messages="$errors->get('satuan_terkecil')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="harga_estimasi" value="Harga Estimasi (Rp)" />
                <x-text-input id="harga_estimasi" name="harga_estimasi" type="number" min="0" class="mt-1 block w-full" :value="old('harga_estimasi', 0)" required />
                <x-input-error :messages="$errors->get('harga_estimasi')" class="mt-2" />
            </div>
            <div class="flex gap-2">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('master-bahan.index') }}" class="px-4 py-2 border rounded text-sm">Batal</a>
            </div>
        </form>
    </div></div>
</x-app-layout>
