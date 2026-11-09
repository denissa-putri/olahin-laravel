<?php

namespace App\Http\Controllers;

use App\Http\Requests\StokUserRequest;
use App\Models\MasterBahan;
use App\Models\StokUser;
use Illuminate\Http\Request;

class StokUserController extends Controller
{
    public function index(Request $request)
    {
        $q = StokUser::with('bahan')->milikUser(auth()->id())->orderBy('tanggal_kadaluarsa');
        if ($request->filter === 'expired') $q->expired();
        if ($request->filter === 'menipis') $q->menipis(3);
        $items = $q->get();
        return view('stok.index', compact('items'));
    }

    public function create()
    {
        $bahan = MasterBahan::orderBy('nama_bahan')->get();
        return view('stok.create', compact('bahan'));
    }

    public function store(StokUserRequest $request)
    {
        $data = $request->validated();
        $data['id_user'] = auth()->id();
        if (empty($data['id_bahan'])) $data['id_bahan'] = null;
        StokUser::create($data);
        return redirect()->route('stok.index')->with('ok', 'Stok ditambahkan.');
    }

    public function edit(StokUser $stok)
    {
        abort_unless($stok->id_user === auth()->id(), 403);
        $bahan = MasterBahan::orderBy('nama_bahan')->get();
        return view('stok.edit', ['item' => $stok, 'bahan' => $bahan]);
    }

    public function update(StokUserRequest $request, StokUser $stok)
    {
        abort_unless($stok->id_user === auth()->id(), 403);
        $data = $request->validated();
        if (empty($data['id_bahan'])) $data['id_bahan'] = null;
        $stok->update($data);
        return redirect()->route('stok.index')->with('ok', 'Stok diperbarui.');
    }

    public function destroy(StokUser $stok)
    {
        abort_unless($stok->id_user === auth()->id(), 403);
        $stok->delete();
        return back()->with('ok', 'Stok dihapus.');
    }
}
