<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\BarangModel;
use App\Models\Data\StokModel;
use App\Models\Data\TokoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class StokController extends Controller
{
    public function stokView()
    {
        // DB::enableQueryLog();
        $data = StokModel::with(['barang', 'toko'])->get();
        $toko = TokoModel::all();
        $barang = BarangModel::all();
        // dd($data);
        // dd(DB::getQueryLog());
        return view('konten.stok', compact(['data', 'toko', 'barang']));
    }

    public function create(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'barang' => 'required|string|max:255',
            'toko' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
        ]);

        $existingStok = StokModel::where('idproduk', $validatedData['barang'])
            ->where('idtoko', $validatedData['toko'])
            ->first();
        // dd($existingStok);
        if ($existingStok) {
            return response()->json([
                'message' => 'Data stok untuk produk dan toko ini sudah ada.'
            ], 409); // 409 = Conflict
        }

        $stok = new StokModel();
        $stok->idproduk = $validatedData['barang'];
        $stok->idtoko = $validatedData['toko'];
        $stok->jumlah = $validatedData['jumlah'];
        $stok->save();

        return response()->json(['message' => 'Barang berhasil ditambahkan']);
    }

    public function getTokoBarang($id)
    {
        $data = StokModel::where('idtoko', $id)->with('toko', 'barang')->get(); // Mengambil data barang untuk toko tertentu
        return response()->json($data);
    }

    // Fungsi untuk update data toko
    public function updateStok(Request $request, $id)
    {
        $data = StokModel::where('idtoko', $id)->with('toko', 'barang')->get(); // Mengambil data barang untuk toko tertentu

        // Mengambil item pertama dari koleksi
        $stok = $data[0];

        // Menambahkan jumlah yang baru dengan yang sudah ada
        $jums = $stok->jumlah + $request->jumlah;

        // Memperbarui jumlah
        $stok->jumlah = $jums;

        // Menyimpan perubahan ke database
        $stok->save();

        return response()->json(['success' => 'Data berhasil diperbarui']);
    }

    public function deleteBarang($id)
    {
        $stok = StokModel::find($id);
        $stok->delete();

        return response()->json(['success' => 'Data berhasil dihapus']);
    }
}
