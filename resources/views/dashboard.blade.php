<x-app-layout>
    <div class="py-8 bg-[#FBF7EE] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">

            <!-- 1. Hero Banner Selamat Pagi Sesuai Desain Figma -->
            <div class="relative rounded-[36px] overflow-hidden shadow-lg h-[320px] sm:h-[380px] flex items-center bg-gray-900">
                <!-- Background Image: Meja kayu dengan pasta, tomat, sendok kayu, serbet garis -->
                <img src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1600&q=80"
                     alt="Banner Olahin"
                     class="absolute inset-0 w-full h-full object-cover opacity-85 filter brightness-90">
                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/40 to-transparent"></div>

                <!-- Text & Button Hero -->
                <div class="relative z-10 px-8 sm:px-14 max-w-xl">
                    <h1 class="text-3xl sm:text-5xl font-extrabold text-white leading-tight tracking-tight">
                        Selamat Pagi,<br>
                        Yuk Mau Olahin apa hari ini?
                    </h1>
                    <div class="mt-7">
                        <a href="{{ route('resep.index') }}"
                           class="inline-block bg-[#FF7A00] hover:bg-[#e06b00] text-white font-bold py-3.5 px-8 rounded-full shadow-lg transition duration-200 transform hover:scale-105 text-sm sm:text-base">
                            Jelajahi Resep
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. Dual Cards: Anggaran Makananmu & Riwayat Bahan Yang Dibeli -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card Kiri: Anggaran Makananmu (Koneksi Real-time ke Modul Farrel) -->
                <div class="bg-white rounded-[32px] p-7 shadow-sm border border-orange-50/50 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-[#143E35]">Anggaran makananmu</h2>
                        <p class="text-xs text-gray-500 mt-1">Rangkuman pengeluaran makanan bulanan kamu ada disini!</p>

                        <div class="mt-6 text-center sm:text-left">
                            <div class="text-3xl font-extrabold text-[#111827]">
                                Rp{{ number_format($anggaran->total_pengeluaran_aktual, 0, ',', '.') }}
                            </div>
                            <div class="text-xs text-gray-400 mt-1">
                                Dari Rp{{ number_format($anggaran->target_bulanan, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Progress Bar & Sisa -->
                        <div class="mt-5">
                            <div class="flex justify-end text-xs font-bold text-gray-600 mb-1">
                                {{ $persenTerpakai }}%
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-[#143E35] h-2.5 rounded-full transition-all duration-500" style="width: {{ $persenTerpakai }}%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-2 font-medium">
                                Sisa Rp{{ number_format($sisaAnggaran, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-7">
                        <a href="{{ route('anggaran.index') }}"
                           class="block w-full bg-[#FF7A00] hover:bg-[#e06b00] text-white font-semibold py-3 px-4 rounded-2xl transition duration-200 text-center text-sm shadow">
                            Lihat detail anggaran
                        </a>
                    </div>
                </div>

                <!-- Card Kanan: Riwayat Bahan yang Dibeli -->
                <div class="bg-white rounded-[32px] p-7 shadow-sm border border-orange-50/50 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-[#143E35]">Riwayat bahan yang dibeli</h2>
                        <p class="text-xs text-gray-500 mt-1">Terbanyak setiap minggu</p>

                        <div class="mt-6 space-y-4">
                            @if($riwayatKategori->isNotEmpty())
                                @foreach($riwayatKategori as $kat)
                                    <div class="flex items-center justify-between text-sm py-1 border-b border-gray-50">
                                        <span class="font-medium text-gray-700">{{ $kat->kategori ?? 'Umum' }}</span>
                                        <span class="font-semibold text-gray-900">{{ $kat->total }} barang</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center justify-between text-sm py-1 border-b border-gray-50">
                                    <span class="font-medium text-gray-700">Sayuran</span>
                                    <span class="font-semibold text-gray-900">10 barang</span>
                                </div>
                                <div class="flex items-center justify-between text-sm py-1 border-b border-gray-50">
                                    <span class="font-medium text-gray-700">Daging</span>
                                    <span class="font-semibold text-gray-900">10 barang</span>
                                </div>
                                <div class="flex items-center justify-between text-sm py-1">
                                    <span class="font-medium text-gray-700">Bumbu</span>
                                    <span class="font-semibold text-gray-900">10 barang</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-7">
                        <a href="{{ route('stok.index') }}"
                           class="block w-full bg-[#FF7A00] hover:bg-[#e06b00] text-white font-semibold py-3 px-4 rounded-2xl transition duration-200 text-center text-sm shadow">
                            Lihat Kelola Bahan
                        </a>
                    </div>
                </div>

            </div>

            <!-- 3. Section: Resep Trending -->
            <div class="space-y-4">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-[#111827]">Resep Trending</h2>
                    <p class="text-xs text-gray-500 mt-1">Rekomendasi resep berdasarkan bahan yang kamu punya</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                    @foreach($resepTrending as $resep)
                        <div class="bg-white rounded-[28px] overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition duration-200 flex flex-col justify-between">
                            <div>
                                <!-- Image Card dengan Badge Rating & Tag -->
                                <div class="relative h-48 w-full overflow-hidden bg-gray-100">
                                    <img src="{{ $resep->gambar_url ?: 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80' }}"
                                         alt="{{ $resep->judul_resep }}"
                                         class="w-full h-full object-cover">
                                    <!-- Badge Rating -->
                                    <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1 rounded-full flex items-center space-x-1 shadow text-xs font-bold text-gray-800">
                                        <span class="text-amber-500">★</span>
                                        <span>{{ $resep->rating ?? 4.8 }}</span>
                                    </div>
                                    <!-- Badge Tag -->
                                    <div class="absolute top-3 right-3 bg-black/40 backdrop-blur-sm text-white px-3 py-1 rounded-full text-[11px] font-medium">
                                        {{ $resep->tag ?? ($resep->kategori ?? 'Rekomendasi') }}
                                    </div>
                                </div>

                                <!-- Body Card -->
                                <div class="p-5">
                                    <div class="flex items-start justify-between">
                                        <h3 class="font-bold text-gray-900 text-base">
                                            @if(!empty($resep->id_resep))
                                                <a href="{{ route('resep.show', $resep->id_resep) }}" class="hover:text-orange-600 transition">
                                                    {{ $resep->judul_resep }}
                                                </a>
                                            @else
                                                <a href="{{ route('resep.index') }}" class="hover:text-orange-600 transition">
                                                    {{ $resep->judul_resep }}
                                                </a>
                                            @endif
                                        </h3>
                                        <!-- Bookmark Icon -->
                                        <button class="text-orange-500 hover:text-orange-600 p-1">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Info Meta (Waktu, Kesulitan, Porsi) -->
                                    <div class="flex items-center space-x-3 text-xs text-gray-500 mt-2 font-medium">
                                        <span>⏱ {{ $resep->waktu_memasak }} Menit</span>
                                        <span>•</span>
                                        <span>{{ $resep->kesulitan }}</span>
                                        <span>•</span>
                                        <span>🍽 {{ $resep->porsi }} Porsi</span>
                                    </div>

                                    <p class="text-xs text-gray-600 mt-3 line-clamp-2">
                                        {{ $resep->instruksi_masak }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 4. Section: Berita Terkini -->
            <div class="space-y-4 pt-4">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-[#111827]">Berita Terkini</h2>
                    <p class="text-xs text-gray-500 mt-1">Semua informasi harga bahan untuk keuangan yang lebih teratur</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                    @foreach($beritaTerkini as $berita)
                        <div class="bg-white rounded-[28px] overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition duration-200">
                            <div class="h-44 w-full overflow-hidden">
                                <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5">
                                <h3 class="font-semibold text-gray-900 text-xs sm:text-sm leading-snug line-clamp-3">
                                    {{ $berita->judul }}
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 5. Footer Sesuai Figma -->
            <footer class="pt-12 pb-6 border-t border-orange-100/60 mt-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Brand -->
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-black text-[#FF7A00]">Olahin'</span>
                        </div>
                        <p class="text-xs text-gray-500 font-medium">Masak terencana, dompet terjaga</p>
                    </div>

                    <!-- Company -->
                    <div>
                        <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Company</h4>
                        <ul class="space-y-2 text-xs text-gray-600">
                            <li><a href="#" class="hover:text-orange-600">About us</a></li>
                            <li><a href="#" class="hover:text-orange-600">Career</a></li>
                            <li><a href="#" class="hover:text-orange-600">Blog</a></li>
                        </ul>
                    </div>

                    <!-- Features -->
                    <div>
                        <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Features</h4>
                        <ul class="space-y-2 text-xs text-gray-600">
                            <li><a href="{{ route('anggaran.index') }}" class="hover:text-orange-600">Anggaran</a></li>
                            <li><a href="{{ route('stok.index') }}" class="hover:text-orange-600">Kelola bahan</a></li>
                            <li><a href="{{ route('resep.index') }}" class="hover:text-orange-600">Resep cerdas</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="text-xs font-bold text-gray-900 uppercase tracking-wider mb-3">Support</h4>
                        <ul class="space-y-2 text-xs text-gray-600">
                            <li><a href="#" class="hover:text-orange-600">Help center</a></li>
                            <li><a href="#" class="hover:text-orange-600">Customer service</a></li>
                        </ul>
                    </div>
                </div>
            </footer>

        </div>
    </div>
</x-app-layout>
