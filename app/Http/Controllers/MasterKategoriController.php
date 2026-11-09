<?php

namespace App\Http\Controllers;

use App\Http\Requests\MasterKategoriRequest;
use App\Models\MasterKategori;

class MasterKategoriController extends Controller
{
    public function index()
    {
        $items = MasterKategori::orderBy('nama_kategori')->get();
        return view('master-kategori.index', compact('items'));
    }

    public function create()
    {
        return view('master-kategori.create');
    }

    public function store(MasterKategoriRequest $request)
    {
        MasterKategori::create($request->validated());
        return redirect()->route('master-kategori.index')->with('ok', 'Kategori ditambahkan.');
    }

    public function edit(MasterKategori $master_kategori)
    {
        return view('master-kategori.edit', ['item' => $master_kategori]);
    }

    public function update(MasterKategoriRequest $request, MasterKategori $master_kategori)
    {
        $master_kategori->update($request->validated());
        return redirect()->route('master-kategori.index')->with('ok', 'Kategori diperbarui.');
    }

    public function destroy(MasterKategori $master_kategori)
    {
        $master_kategori->delete();
        return back()->with('ok', 'Kategori dihapus.');
    }
}
