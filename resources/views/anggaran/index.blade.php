<x-app-layout>
    <div class="py-8 bg-[#FBF7EE] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Alert Flash Message -->
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-xl bg-green-100 border border-green-200 shadow-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-900 font-bold ml-4">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-xl bg-red-100 border border-red-200 shadow-sm">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Top Grid: Status Anggaran & Bar Chart -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Card 1: Status Anggaran Sekarang -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-orange-50 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-[#143E35]">Status anggaran sekarang</h2>
                            <!-- Trigger Edit Target -->
                            <button onclick="openTargetModal()" class="text-xs text-orange-600 hover:underline font-semibold">
                                Atur Target
                            </button>
                        </div>
                        <p class="text-sm text-gray-400 mt-1">Anggaran untuk {{ date('Y', strtotime($bulanTahun . '-01')) }}</p>

                        <div class="mt-8">
                            <div class="text-3xl font-extrabold text-[#111827]">
                                Rp{{ number_format($anggaran->total_pengeluaran_aktual, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-500 mt-1">
                                Dari Rp{{ number_format($anggaran->target_bulanan, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mt-6">
                            <div class="flex justify-end text-xs font-bold text-gray-600 mb-1">
                                {{ $persenTerpakai }}%
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                <div class="bg-[#143E35] h-3 rounded-full transition-all duration-500" style="width: {{ $persenTerpakai }}%"></div>
                            </div>
                            <div class="text-xs text-gray-500 mt-2 font-medium">
                                Sisa Rp{{ number_format($sisaAnggaran, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button onclick="openTargetModal()" class="w-full bg-[#FF7A00] hover:bg-[#e06b00] text-white font-semibold py-3 px-4 rounded-2xl transition duration-200 text-center shadow">
                            Atur & Sesuaikan Anggaran
                        </button>
                    </div>
                </div>

                <!-- Card 2: Data Pengeluaran /Minggu (Bar Chart Persis Figma) -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-orange-50 flex flex-col justify-between">
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-xl font-bold text-[#143E35]">Data pengeluaran</h2>
                        <span class="text-sm text-gray-500 font-medium">/Minggu</span>
                    </div>

                    <!-- Chart Container dengan Sumbu Y & Gridlines persis Figma -->
                    @php
                        // Skala Y axis berdasarkan target anggaran atau pengeluaran tertinggi
                        $maxMingguan = max(array_values($chartMingguan));
                        // Baseline skala minimal misalnya 1.000.000 atau proporsional dengan target
                        $chartTargetY = max($anggaran->target_bulanan > 0 ? ($anggaran->target_bulanan / 2) : 500000, $maxMingguan);
                        if ($chartTargetY <= 0) $chartTargetY = 500000;
                    @endphp

                    <div class="relative h-64 pt-6 pb-2 flex">
                        <!-- Y-Axis Labels -->
                        <div class="flex flex-col justify-between text-[11px] text-gray-400 font-medium pr-3 py-1 select-none text-right w-16">
                            <span>Rp{{ number_format($chartTargetY, 0, ',', '.') }}</span>
                            <span>Rp{{ number_format($chartTargetY * 0.75, 0, ',', '.') }}</span>
                            <span>Rp{{ number_format($chartTargetY * 0.5, 0, ',', '.') }}</span>
                            <span>Rp{{ number_format($chartTargetY * 0.25, 0, ',', '.') }}</span>
                            <span>0</span>
                        </div>

                        <!-- Chart Area dengan Grid Lines Horizontal & Bar -->
                        <div class="flex-1 relative flex flex-col justify-between">
                            <!-- Background Grid Lines -->
                            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none">
                                <div class="border-b border-gray-100 w-full h-0"></div>
                                <div class="border-b border-gray-100 w-full h-0"></div>
                                <div class="border-b border-gray-100 w-full h-0"></div>
                                <div class="border-b border-gray-100 w-full h-0"></div>
                                <div class="border-b border-gray-200 w-full h-0"></div>
                            </div>

                            <!-- Bar Columns (Minggu 1 s/d 4) -->
                            <div class="absolute inset-0 flex items-end justify-around px-2 z-10">
                                @for($m = 1; $m <= 4; $m++)
                                    @php
                                        $val = $chartMingguan[$m] ?? 0;
                                        // Hitung tinggi persen terhadap $chartTargetY (skala tetap)
                                        $heightPercent = $val > 0 ? min(100, max(6, round(($val / $chartTargetY) * 100))) : 0;
                                    @endphp
                                    <div class="flex flex-col items-center w-14 h-full justify-end group relative">
                                        <!-- Tooltip Hover Nominal -->
                                        <div class="absolute -top-7 bg-gray-800 text-white text-[11px] py-1 px-2 rounded-lg opacity-0 group-hover:opacity-100 transition duration-150 pointer-events-none whitespace-nowrap z-20 shadow-md">
                                            Minggu {{ $m }}: Rp{{ number_format($val, 0, ',', '.') }}
                                        </div>

                                        <!-- The Orange Bar (Persis Figma) -->
                                        @if($heightPercent > 0)
                                            <div class="w-full bg-[#FF7A00] rounded-xl transition-all duration-500 group-hover:bg-[#e06b00] shadow-sm"
                                                 style="height: {{ $heightPercent }}%;">
                                            </div>
                                        @else
                                            <div class="w-full bg-orange-100/60 rounded-xl transition-all duration-300"
                                                 style="height: 4px;">
                                            </div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- X-Axis Labels (1, 2, 3, 4) -->
                    <div class="flex justify-around pl-16 pr-2 pt-2 text-xs font-semibold text-gray-500">
                        @for($m = 1; $m <= 4; $m++)
                            <span class="w-14 text-center">{{ $m }}</span>
                        @endfor
                    </div>
                </div>

            </div>

            <!-- Bottom Section: Belanja Mingguan (Kanban Grid) -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-orange-50">
                <!-- Header Belanja Mingguan -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 gap-4">
                    <h2 class="text-2xl font-bold text-[#111827]">Belanja Mingguan</h2>

                    <!-- Filter Minggu & Bulan -->
                    <form method="GET" action="{{ route('anggaran.index') }}" class="flex items-center space-x-2">
                        <input type="month" name="bulan_tahun" value="{{ $bulanTahun }}"
                               onchange="this.form.submit()"
                               class="text-xs rounded-xl border-gray-300 text-gray-700 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        <select name="minggu_ke" onchange="this.form.submit()"
                                class="text-xs rounded-xl border-gray-300 text-gray-700 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                            @for($m = 1; $m <= 4; $m++)
                                <option value="{{ $m }}" {{ $mingguKe == $m ? 'selected' : '' }}>
                                    Minggu ke-{{ $m }}
                                </option>
                            @endfor
                        </select>
                    </form>
                </div>

                <!-- Kanban Columns Hari -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    @foreach($hariList as $hari)
                        <div class="flex flex-col justify-between pt-4 md:pt-0 {{ !$loop->first ? 'md:pl-4' : '' }}">
                            <div>
                                <h3 class="font-bold text-[#111827] text-base mb-4">{{ $hari }}</h3>

                                <!-- Item Belanja List -->
                                <div class="space-y-3">
                                    @forelse($groceriesByHari[$hari] as $item)
                                        <div class="bg-[#F9FAFB] hover:bg-orange-50/50 p-3 rounded-2xl border border-gray-100 transition shadow-sm relative group">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <p class="text-xs font-semibold text-gray-800">{{ $item->nama_barang }} - {{ $item->kuantitas }}</p>
                                                    <p class="text-xs text-gray-500 mt-1">Rp.{{ number_format($item->harga, 0, ',', '.') }}</p>
                                                </div>

                                                <!-- Action Buttons: Edit & Delete -->
                                                <div class="flex items-center space-x-1 opacity-80 group-hover:opacity-100">
                                                    <button onclick='openEditModal(@json($item))' title="Edit" class="p-1 text-gray-400 hover:text-orange-600 transition">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                        </svg>
                                                    </button>
                                                    <form action="{{ route('anggaran.grocery.destroy', $item->id_grocery) }}" method="POST" onsubmit="return confirm('Hapus barang belanjaan ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" title="Hapus" class="p-1 text-gray-400 hover:text-red-600 transition">
                                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="text-[11px] text-gray-400 italic py-2">Belum ada belanjaan</div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Tombol Plus Add Card Sesuai Figma -->
                            <div class="mt-6 flex justify-center">
                                <button type="button" onclick="openCreateModal('{{ $hari }}')"
                                        class="w-9 h-9 rounded-full bg-[#FF9D00] hover:bg-[#e58d00] text-white flex items-center justify-center font-bold text-lg shadow-md transition transform hover:scale-110">
                                    +
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!-- MODAL POPUP TAMBAH / EDIT BELANJAAN (SESUAI GAMBAR FIGMA FORM 1) -->
    <div id="groceryModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-40 flex items-center justify-center p-4">
        <div class="bg-white rounded-[32px] max-w-lg w-full p-8 shadow-2xl relative border border-gray-100 transition-all transform">
            <!-- Close Button X -->
            <button onclick="closeGroceryModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 text-xl font-bold">
                &times;
            </button>

            <!-- Judul Modal -->
            <h3 id="modalTitle" class="text-2xl font-bold text-[#111827] mb-6">Tambah bahan belanjaan</h3>

            <form id="groceryForm" method="POST" action="{{ route('anggaran.grocery.store') }}">
                @csrf
                <div id="methodSpoofing"></div>

                <input type="hidden" name="minggu_ke" value="{{ $mingguKe }}">
                <input type="hidden" name="bulan_tahun" value="{{ $bulanTahun }}">

                <!-- Input Hari (Hidden/Preset) -->
                <input type="hidden" id="formHari" name="hari" value="Senin">

                <!-- Nama Bahan -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Nama Bahan</label>
                    <input type="text" id="formNamaBarang" name="nama_barang" placeholder="Contoh: Bawang Merah" required
                           class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent text-sm">
                </div>

                <!-- Kuantitas & Satuan -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Kuantitas</label>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="number" step="0.01" id="formJumlah" name="jumlah" placeholder="Jumlah (misal: 1 atau 500)" required
                               class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent text-sm">
                        <select id="formSatuan" name="satuan" required
                                class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent text-sm">
                            <option value="kg">kg</option>
                            <option value="gram">gram</option>
                            <option value="liter">liter</option>
                            <option value="ml">ml</option>
                            <option value="butir">butir</option>
                            <option value="ikat">ikat</option>
                            <option value="bungkus">bungkus</option>
                            <option value="pcs">pcs</option>
                        </select>
                    </div>
                </div>

                <!-- Harga -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Harga (Rp)</label>
                    <input type="number" id="formHarga" name="harga" placeholder="Contoh: 20000" required
                           class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent text-sm">
                </div>

                <!-- Kategori Bahan -->
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">Kategori bahan</label>
                    <input type="text" id="formKategori" name="kategori" placeholder="Contoh: Sayur, Bumbu, Sembako"
                           class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent text-sm">
                </div>

                <!-- Action Buttons: Batal & Simpan -->
                <div class="flex items-center space-x-4">
                    <button type="button" onclick="closeGroceryModal()"
                            class="w-1/2 py-3 border border-gray-400 text-gray-700 font-semibold rounded-full hover:bg-gray-50 transition text-sm">
                        Batal
                    </button>
                    <button type="submit"
                            class="w-1/2 py-3 bg-[#FF7A00] hover:bg-[#e06b00] text-white font-semibold rounded-full shadow-md transition text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL ATUR TARGET ANGGARAN -->
    <div id="targetModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-40 flex items-center justify-center p-4">
        <div class="bg-white rounded-[32px] max-w-md w-full p-8 shadow-2xl relative border border-gray-100">
            <button onclick="closeTargetModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
            <h3 class="text-xl font-bold text-[#111827] mb-4">Atur Target Anggaran Bulanan</h3>

            <form method="POST" action="{{ route('anggaran.target.update') }}">
                @csrf
                <input type="hidden" name="bulan_tahun" value="{{ $bulanTahun }}">

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Target Budget (Rp)</label>
                    <input type="number" name="target_bulanan" value="{{ $anggaran->target_bulanan }}" required
                           class="w-full px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#FF7A00] focus:border-transparent text-sm">
                </div>

                <div class="flex items-center space-x-4">
                    <button type="button" onclick="closeTargetModal()" class="w-1/2 py-3 border border-gray-400 text-gray-700 font-semibold rounded-full hover:bg-gray-50 text-sm">
                        Batal
                    </button>
                    <button type="submit" class="w-1/2 py-3 bg-[#FF7A00] hover:bg-[#e06b00] text-white font-semibold rounded-full text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC UNTUK MODAL TAMBAH/EDIT -->
    <script>
        function openCreateModal(hari) {
            document.getElementById('modalTitle').innerText = 'Tambah bahan belanjaan (' + hari + ')';
            document.getElementById('groceryForm').action = "{{ route('anggaran.grocery.store') }}";
            document.getElementById('methodSpoofing').innerHTML = '';
            document.getElementById('formHari').value = hari;
            document.getElementById('formNamaBarang').value = '';
            document.getElementById('formJumlah').value = '';
            document.getElementById('formSatuan').value = 'kg';
            document.getElementById('formHarga').value = '';
            document.getElementById('formKategori').value = '';
            document.getElementById('groceryModal').classList.remove('hidden');
        }

        function openEditModal(item) {
            document.getElementById('modalTitle').innerText = 'Edit bahan belanjaan';
            document.getElementById('groceryForm').action = "/anggaran/grocery/" + item.id_grocery;
            document.getElementById('methodSpoofing').innerHTML = '@method("PUT")';
            document.getElementById('formHari').value = item.hari;
            document.getElementById('formNamaBarang').value = item.nama_barang;

            // Pisahkan kuantitas menjadi angka dan satuan jika ada
            let parts = (item.kuantitas || '').split(' ');
            let qty = parts[0] || '';
            let unit = parts[1] || 'kg';

            document.getElementById('formJumlah').value = qty;
            document.getElementById('formSatuan').value = unit;
            document.getElementById('formHarga').value = item.harga;
            document.getElementById('formKategori').value = item.kategori || '';
            document.getElementById('groceryModal').classList.remove('hidden');
        }

        function closeGroceryModal() {
            document.getElementById('groceryModal').classList.add('hidden');
        }

        function openTargetModal() {
            document.getElementById('targetModal').classList.remove('hidden');
        }

        function closeTargetModal() {
            document.getElementById('targetModal').classList.add('hidden');
        }
    </script>
</x-app-layout>

