<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'namebarang' => 'required|string|max:255',
            'hargabarang' => 'required|string|max:255',
        ]);

        $barang = new BarangModel();
        $barang->namebarang = $validatedData['namebarang'];
        $barang->harga = $validatedData['hargabarang'];
        $barang->idcompany = 1;
        $barang->save();

        return response()->json(['success' => 'Barang berhasil ditambahkan']);
    }

    public function barangView()
    {
        $data = BarangModel::all();
        return view('konten.barang', compact('data'));
    }
    // Fungsi untuk mengambil data barang berdasarkan ID
    public function getBarang($id)
    {
        $barang = BarangModel::find($id);
        return response()->json($barang);
    }

    // Fungsi untuk update data barang
    public function updateBarang(Request $request, $id)
    {
        $barang = BarangModel::find($id);
        $barang->namebarang = $request->namebarang;
        $barang->harga = $request->hargabarang;
        $barang->save();

        return response()->json(['success' => 'Data berhasil diperbarui']);
    }

    // Fungsi untuk menghapus data barang
    public function deleteBarang($id)
    {
        $barang = BarangModel::find($id);
        $barang->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
