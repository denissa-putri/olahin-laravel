<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Stok</h2></x-slot>
    <div class="py-6"><div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm sm:rounded-lg">
        <form method="POST" action="{{ route('stok.store') }}" class="space-y-4">
            @csrf
            <div>
                <x-input-label for="id_bahan" value="Pilih Bahan (master)" />
                <select id="id_bahan" name="id_bahan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">-- isi nama custom di bawah --</option>
                    @foreach($bahan as $b)
                        <option value="{{ $b->id_bahan }}" @selected(old('id_bahan')==$b->id_bahan)>{{ $b->nama_bahan }} ({{ $b->satuan_terkecil }})</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('id_bahan')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="nama_bahan_custom" value="Nama Bahan Custom (jika tidak pilih master)" />
                <x-text-input id="nama_bahan_custom" name="nama_bahan_custom" type="text" class="mt-1 block w-full" :value="old('nama_bahan_custom')" />
                <x-input-error :messages="$errors->get('nama_bahan_custom')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="kuantitas" value="Kuantitas (contoh: 500 gr, 2 pcs)" />
                <x-text-input id="kuantitas" name="kuantitas" type="text" class="mt-1 block w-full" :value="old('kuantitas')" required />
                <x-input-error :messages="$errors->get('kuantitas')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="tanggal_kadaluarsa" value="Tanggal Kadaluarsa" />
                <x-text-input id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" type="date" class="mt-1 block w-full" :value="old('tanggal_kadaluarsa')" required />
                <x-input-error :messages="$errors->get('tanggal_kadaluarsa')" class="mt-2" />
            </div>
            <div class="flex gap-2">
                <x-primary-button>Simpan</x-primary-button>
                <a href="{{ route('stok.index') }}" class="px-4 py-2 border rounded text-sm">Batal</a>
            </div>
        </form>
    </div></div>
</x-app-layout>
