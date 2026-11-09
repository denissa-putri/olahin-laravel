<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use App\Models\KebutuhanBahan;
use App\Models\CatatanMasak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function index()
    {
        $resep = Resep::where('id_user', Auth::id())->get();
        return view('resep.index', compact('resep'));
    }

    
    public function create()
    {
        $bahan = DB::table('master_bahan')->get();
        return view('resep.create', compact('bahan'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'judul_resep' => 'required|string|max:255',
            'instruksi_masak' => 'required|string',
            'porsi' => 'required|numeric',
            'id_bahan' => 'required', 
            'takaran' => 'required|string',
            'isi_catatan' => 'nullable|string',
        ]);

        $resep = Resep::create([
            'id_user' => Auth::id(),
            'judul_resep' => $request->judul_resep,
            'instruksi_masak' => $request->instruksi_masak,
            'porsi' => $request->porsi,
        ]);

        KebutuhanBahan::create([
            'id_resep' => $resep->id_resep,
            'id_bahan' => $request->id_bahan,
            'takaran' => $request->takaran,
        ]);

        if ($request->filled('isi_catatan')) {
            CatatanMasak::create([
                'id_resep' => $resep->id_resep,
                'isi_catatan' => $request->isi_catatan,
            ]);
        }
        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan.');

        Resep::create([
            'id_user' => Auth::id(),
            'judul_resep' => $request->judul_resep,
            'instruksi_masak' => $request->instruksi_masak,
            'porsi' => $request->porsi,
        ]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $resep = Resep::where('id_user', Auth::id())->where('id_resep', $id)->firstOrFail();
        return view('resep.edit', compact('resep'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_resep' => 'required|string|max:255',
            'instruksi_masak' => 'required|string',
            'porsi' => 'required|numeric',
        ]);

        $resep = Resep::where('id_user', Auth::id())->where('id_resep', $id)->firstOrFail();
        $resep->update([
            'judul_resep' => $request->judul_resep,
            'instruksi_masak' => $request->instruksi_masak,
            'porsi' => $request->porsi,
        ]);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $resep = Resep::where('id_user', Auth::id())->where('id_resep', $id)->firstOrFail();
        $resep->delete();

        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus.');
    }
}
