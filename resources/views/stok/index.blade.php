<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Stok Bahan Saya</h2></x-slot>
    <div class="py-6"><div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        @if(session('ok'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('ok') }}</div>@endif
        <div class="mb-4 flex flex-wrap gap-2 items-center">
            <a href="{{ route('stok.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">+ Tambah Stok</a>
            <a href="{{ route('stok.index') }}" class="px-3 py-2 border rounded text-sm">Semua</a>
            <a href="{{ route('stok.index', ['filter'=>'menipis']) }}" class="px-3 py-2 border rounded text-sm bg-yellow-50">Menipis (&le;3 hari)</a>
            <a href="{{ route('stok.index', ['filter'=>'expired']) }}" class="px-3 py-2 border rounded text-sm bg-red-50">Expired</a>
        </div>
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50"><tr>
                    <th class="px-4 py-2 text-left">Bahan</th><th class="px-4 py-2">Qty</th><th class="px-4 py-2">Kadaluarsa</th><th class="px-4 py-2">Status</th><th class="px-4 py-2">Aksi</th>
                </tr></thead>
                <tbody>
                @forelse($items as $it)
                    @php $s = $it->status_kadaluarsa; @endphp
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $it->nama_tampil }}</td>
                        <td class="px-4 py-2 text-center">{{ $it->kuantitas }}</td>
                        <td class="px-4 py-2 text-center">{{ optional($it->tanggal_kadaluarsa)->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">
                            <span class="px-2 py-1 rounded text-xs {{ $s==='EXPIRED'?'bg-red-100 text-red-800':($s==='MENIPIS'?'bg-yellow-100 text-yellow-800':'bg-green-100 text-green-800') }}">{{ $s }}</span>
                        </td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('stok.edit', $it) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('stok.destroy', $it) }}" method="POST" class="inline" onsubmit="return confirm('Hapus stok ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada stok.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</x-app-layout>
