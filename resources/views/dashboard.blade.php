<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('stok.index') }}" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50">
                    <div class="text-sm text-gray-500">Total Stok</div>
                    <div class="text-3xl font-bold text-gray-800">{{ $totalStok ?? 0 }}</div>
                </a>
                <a href="{{ route('stok.index', ['filter' => 'menipis']) }}" class="block bg-yellow-50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-yellow-100">
                    <div class="text-sm text-yellow-700">Stok Menipis (&le;3 hari)</div>
                    <div class="text-3xl font-bold text-yellow-800">{{ $menipis ?? 0 }}</div>
                </a>
                <a href="{{ route('stok.index', ['filter' => 'expired']) }}" class="block bg-red-50 overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-red-100">
                    <div class="text-sm text-red-700">Stok Expired</div>
                    <div class="text-3xl font-bold text-red-800">{{ $expired ?? 0 }}</div>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-lg">Stok Terdekat Kadaluarsa</h3>
                        <a href="{{ route('stok.create') }}" class="text-sm text-indigo-600">+ Tambah Stok</a>
                    </div>
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50"><tr>
                            <th class="px-3 py-2 text-left">Bahan</th><th class="px-3 py-2">Qty</th><th class="px-3 py-2">Kadaluarsa</th><th class="px-3 py-2">Status</th>
                        </tr></thead>
                        <tbody>
                        @forelse(($stokTerbaru ?? []) as $it)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $it->nama_tampil }}</td>
                                <td class="px-3 py-2 text-center">{{ $it->kuantitas }}</td>
                                <td class="px-3 py-2 text-center">{{ optional($it->tanggal_kadaluarsa)->format('d/m/Y') }}</td>
                                <td class="px-3 py-2 text-center">{{ $it->status_kadaluarsa }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-3 py-3 text-center text-gray-500">Belum ada stok. <a href="{{ route('stok.create') }}" class="text-indigo-600">Tambah sekarang</a>.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
