<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\TokoModel;
use Illuminate\Http\Request;

class TokoController extends Controller
{

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'nametoko' => 'required|string|max:255',
            'alamattoko' => 'required|string|max:255',
        ]);

        $toko = new TokoModel();
        $toko->nametoko = $validatedData['nametoko'];
        $toko->alamattoko = $validatedData['alamattoko'];
        $toko->save();

        return response()->json(['success' => 'Toko berhasil ditambahkan']);
    }

    public function tokoView()
    {
        $data = TokoModel::all();
        return view('konten.toko', compact('data'));
    }
    // Fungsi untuk mengambil data toko berdasarkan ID
    public function getToko($id)
    {
        $toko = TokoModel::find($id);
        return response()->json($toko);
    }

    // Fungsi untuk update data toko
    public function updateToko(Request $request, $id)
    {
        $toko = TokoModel::find($id);
        $toko->nametoko = $request->nametoko;
        $toko->alamattoko = $request->alamattoko;
        $toko->save();

        return response()->json(['success' => 'Data berhasil diperbarui']);
    }

    // Fungsi untuk menghapus data toko
    public function deleteToko($id)
    {
        $toko = TokoModel::find($id);
        $toko->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
    //
}
