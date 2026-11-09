<x-app-layout>
    <!-- Background Krem Keseluruhan -->
    <div class="min-h-screen bg-[#FDF9F1] pb-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Hero Banner (Sesuai Desain Figma) -->
            <div class="bg-gradient-to-r from-[#E6F4EA] to-[#FDF9F1] rounded-3xl p-10 mb-10 shadow-sm relative overflow-hidden border border-green-100">
                <div class="relative z-10 w-full md:w-2/3">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-[#1B4332] mb-6 leading-tight">
                        Eksplorasi Resep dari bahan<br>yang Kamu Punya!
                    </h1>
                    <!-- Dummy Search Bar -->
                    <div class="bg-white rounded-full flex items-center px-4 py-3 shadow-sm mb-4 border border-gray-200 w-full md:w-4/5">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Cari bahan, resep, koki......" class="bg-transparent border-none focus:ring-0 w-full text-sm outline-none" disabled>
                    </div>
                    <div class="flex space-x-3">
                        <button class="bg-white text-xs text-gray-600 font-medium py-2 px-4 rounded-full border border-gray-200 shadow-sm">▽ Filter kategori</button>
                        <button class="bg-white text-xs text-gray-600 font-medium py-2 px-4 rounded-full border border-gray-200 shadow-sm">▽ Filter bahan</button>
                    </div>
                </div>
                <!-- Hiasan Gambar Kanan (Placeholder) -->
                <div class="absolute right-0 top-0 h-full w-1/3 bg-cover bg-left hidden md:block" style="background-image: url('https://images.unsplash.com/photo-1490645935967-10de6ba17061?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'); -webkit-mask-image: linear-gradient(to right, transparent, black 50%);"></div>
            </div>

            <!-- Header Section (Resep Trending & Tombol Tambah) -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-[#1B4332]">Resep Trending</h2>
                <a href="{{ route('resep.create') }}" class="bg-white text-[#1B4332] font-semibold py-2 px-5 rounded-full border-2 border-[#1B4332] hover:bg-[#1B4332] hover:text-white transition-colors shadow-sm text-sm">
                    + Tambah Resep
                </a>
            </div>

            <!-- Grid Card Resep -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($resep as $resep)
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col p-4 transition-transform hover:-translate-y-1">
                        <!-- Gambar Resep Placeholder -->
                        <div class="h-48 bg-gray-200 rounded-2xl mb-4 relative bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60');">
                            <span class="absolute top-3 right-3 bg-white text-xs font-bold px-2 py-1 rounded-full shadow text-gray-600">Dessert</span>
                        </div>
                        
                        <div class="flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-bold text-lg text-gray-800 leading-tight">{{ $resep->judul_resep }}</h3>
                                <button class="text-yellow-500 hover:text-yellow-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg></button>
                            </div>
                            
                            <!-- Meta Info (Waktu, Kesulitan, Porsi) -->
                            <div class="flex space-x-4 text-xs text-gray-500 mb-3 font-medium">
                                <span class="flex items-center"><span class="mr-1">🕒</span> 15 Min</span>
                                <span class="flex items-center"><span class="mr-1">🔥</span> Mudah</span>
                                <span class="flex items-center"><span class="mr-1">🍽</span> {{ $resep->porsi }} Porsi</span>
                            </div>
                            
                            <p class="text-xs text-gray-500 line-clamp-2">{{ $resep->instruksi_masak }}</p>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-gray-100 flex justify-end space-x-3">
                            <a href="{{ route('resep.edit', $resep->id_resep) }}" class="text-yellow-500 text-xs font-bold hover:underline">Edit</a>
                            <form action="{{ route('resep.destroy', $resep->id_resep) }}" method="POST" onsubmit="return confirm('Hapus resep ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 text-xs font-bold hover:underline">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-3xl shadow-sm border border-gray-100">
                        <p class="text-gray-500 font-medium">Belum ada resep. Yuk, tambah resep andalanmu!</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>