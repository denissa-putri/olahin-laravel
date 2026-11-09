<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Kategori</h2></x-slot>
    <div class="py-6"><div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        @if(session('ok'))<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('ok') }}</div>@endif
        <div class="mb-4"><a href="{{ route('master-kategori.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">+ Tambah Kategori</a></div>
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50"><tr><th class="px-4 py-2 text-left">ID</th><th class="px-4 py-2 text-left">Nama Kategori</th><th class="px-4 py-2">Aksi</th></tr></thead>
                <tbody>
                @forelse($items as $it)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $it->id_kategori }}</td>
                        <td class="px-4 py-2">{{ $it->nama_kategori }}</td>
                        <td class="px-4 py-2 text-center space-x-2">
                            <a href="{{ route('master-kategori.edit', $it) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('master-kategori.destroy', $it) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-4 text-center text-gray-500">Belum ada kategori.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div></div>
</x-app-layout>
