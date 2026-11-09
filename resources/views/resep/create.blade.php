<x-app-layout>
    <div class="min-h-screen bg-[#FDF9F1] py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <h2 class="text-center font-extrabold text-3xl text-[#1B4332] mb-10">
                Tambah Resep Baru
            </h2>

            <form action="{{ route('resep.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    
                    <!-- KOLOM KIRI -->
                    <div>
                        <!-- Placeholder Gambar -->
                        <div class="h-56 bg-gray-300 rounded-3xl mb-6 bg-cover bg-center flex items-center justify-center overflow-hidden shadow-sm" style="background-image: url('https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');">
                            <!-- Di fitur asli nanti bisa pakai file input -->
                        </div>

                        <!-- Bahan-bahan -->
                        <div class="mb-8">
                            <h4 class="font-bold text-gray-800 text-lg mb-4">Bahan-bahan</h4>
                            
                            <div class="flex items-center space-x-2 mb-2">
                                <!-- Dropdown Bahan MVP -->
                                <select name="id_bahan" class="w-1/2 rounded-full border-gray-200 shadow-sm text-sm focus:ring-[#95D5A4] focus:border-[#95D5A4]" required>
                                    <option value="" disabled selected>Pilih Bahan...</option>
                                    @foreach($bahan as $bahan)
                                        <option value="{{ $bahan->id_bahan }}">{{ $bahan->nama_bahan }}</option>
                                    @endforeach
                                </select>
                                
                                <!-- Input Takaran MVP -->
                                <input type="text" name="takaran" class="w-1/2 rounded-full border-gray-200 shadow-sm text-sm focus:ring-[#95D5A4] focus:border-[#95D5A4]" placeholder="Misal: 2 Piring / 1 Kg" required>
                                
                                <span class="text-gray-400 cursor-pointer hover:text-red-500 font-bold px-2">✕</span>
                            </div>
                            <button type="button" class="text-yellow-600 font-semibold text-sm flex items-center mt-2">
                                <span class="mr-1 text-lg leading-none">+</span> Tambah Bahan
                            </button>
                        </div>

                        <!-- Langkah-langkah -->
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg mb-4">Langkah-langkah</h4>
                            <div class="flex items-start space-x-3 mb-2">
                                <div class="bg-yellow-500 text-white rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs shrink-0 mt-1">1</div>
                                <textarea name="instruksi_masak" rows="3" class="w-full rounded-2xl border-gray-200 shadow-sm text-sm focus:ring-[#95D5A4] focus:border-[#95D5A4]" placeholder="Panaskan sedikit minyak di wajan..." required></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN -->
                    <div>
                        <!-- Nama Resep -->
                        <div class="mb-5">
                            <label class="block text-sm font-bold text-[#1B4332] mb-2">Nama Resep</label>
                            <input type="text" name="judul_resep" class="w-full rounded-full border-gray-200 shadow-sm focus:ring-[#95D5A4] focus:border-[#95D5A4]" placeholder="Nasi Goreng Spesial Daging Sapi" required>
                        </div>

                        <!-- Deskripsi (Menggunakan Catatan Masak MVP) -->
                        <div class="mb-5">
                            <label class="block text-sm font-bold text-[#1B4332] mb-2">Deskripsi / Catatan Tambahan</label>
                            <textarea name="isi_catatan" rows="3" class="w-full rounded-2xl border-gray-200 shadow-sm focus:ring-[#95D5A4] focus:border-[#95D5A4]" placeholder="Resep yang didapat saat sedang merantau..."></textarea>
                        </div>

                        <!-- Waktu & Porsi -->
                        <div class="grid grid-cols-2 gap-4 mb-10">
                            <div>
                                <label class="block text-sm font-bold text-[#1B4332] mb-2">Waktu (menit)</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🕒</span>
                                    <input type="number" class="w-full rounded-full border-gray-200 shadow-sm pl-10 focus:ring-[#95D5A4] focus:border-[#95D5A4]" placeholder="30 Menit">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-[#1B4332] mb-2">Porsi</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">🍽</span>
                                    <input type="number" name="porsi" class="w-full rounded-full border-gray-200 shadow-sm pl-10 focus:ring-[#95D5A4] focus:border-[#95D5A4]" placeholder="2 Porsi" required>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex justify-end space-x-4 mt-8">
                            <a href="{{ route('resep.index') }}" class="text-red-500 font-bold border-2 border-red-500 bg-transparent rounded-full px-8 py-2.5 hover:bg-red-50 transition-colors shadow-sm">
                                Batalkan
                            </a>
                            <button type="submit" class="bg-[#95D5A4] text-white font-bold rounded-full px-8 py-2.5 hover:bg-green-500 transition-colors shadow-md">
                                Simpan Resep
                            </button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>