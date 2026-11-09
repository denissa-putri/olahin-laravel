<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterBahanRequest;
use App\Models\MasterBahan;
use App\Models\MasterKategori;

class MasterBahanController extends Controller
{
    public function index()
    {
        $items = MasterBahan::with('kategori')->orderBy('nama_bahan')->get();
        return view('master-bahan.index', compact('items'));
    }

    public function create()
    {
        $kategori = MasterKategori::orderBy('nama_kategori')->get();
        return view('master-bahan.create', compact('kategori'));
    }

    public function store(MasterBahanRequest $request)
    {
        MasterBahan::create($request->validated());
        return redirect()->route('master-bahan.index')->with('ok', 'Bahan ditambahkan.');
    }

    public function edit(MasterBahan $master_bahan)
    {
        return view('master-bahan.edit', [
            'item' => $master_bahan,
            'kategori' => MasterKategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function update(MasterBahanRequest $request, MasterBahan $master_bahan)
    {
        $master_bahan->update($request->validated());
        return redirect()->route('master-bahan.index')->with('ok', 'Bahan diperbarui.');
    }

    public function destroy(MasterBahan $master_bahan)
    {
        $master_bahan->delete();
        return back()->with('ok', 'Bahan dihapus.');
    }
}
