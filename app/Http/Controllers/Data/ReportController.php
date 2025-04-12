<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\BarangModel;
use App\Models\Data\ReportModel;
use App\Models\Data\StokModel;
use App\Models\Data\TokoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportjual()
    {
        // dd(session('user'));
        $user = session('user');
        if (!$user) {
            return redirect()->route('login');
        }
        $idtoko = $user->getOriginal('idtoko'); // Mendapatkan idtoko dari session
        if ($idtoko && $idtoko != '') {
            $data = ReportModel::with(['barang', 'toko', 'stok'])
                ->where('idtoko', $idtoko)
                ->get();

            $toko = TokoModel::all();
            $barang = BarangModel::all();
        } else {
            $data = ReportModel::with(['barang', 'toko', 'stok'])->get();
            // dd($data);
            $toko = TokoModel::all();
            $barang = BarangModel::all();
        }
        // DB::enableQueryLog();

        return view('konten.reportjual', compact(['data', 'toko', 'barang']));
    }

    public function getDataJual($id)
    {
        $data = ReportModel::where('idtoko', $id)->with('toko', 'barang')->get(); // Mengambil data barang untuk toko tertentu
        return response()->json($data);
    }

    public function getKasir()
    {
        // dd(session('user'));
        $user = session('user');
        $id = $user->getOriginal('idtoko');
        $data = StokModel::where('idtoko', $id)->with('toko', 'barang')->get();;
        return view('konten.kasir', compact(['data']));
    }

    public function checkOut(Request $request)
    {
        $items = $request->input('items');
        // dd($items[0]);
        try {
            DB::beginTransaction();

            $penjualan = new ReportModel();
            foreach ($items as $item) {
                $penjualan->idstok = $item['id'];
                $penjualan->idtoko = $item['idtoko'];
                $penjualan->idbarang = $item['idproduk'];
                $penjualan->jual = $item['qty'];
                $penjualan->hargajual = $item['qty'] * $item['barang']['harga'];
                $penjualan->save(); // save() digunakan di sini

                $stok = StokModel::find($item['id']);
                if ($stok) {
                    $stok->jumlah -= $item['qty'];
                    $stok->save();
                }
            }
            // $penjualan->tanggal = now();
            // $penjualan->total = collect($items)->sum(fn($item) => $item['qty'] * $item['price']);
            // $penjualan->idstok = $items->id;

            // foreach ($items as $item) {
            //     $detail = new PenjualanDetail();
            //     $detail->penjualan_id = $penjualan->id;
            //     $detail->produk_id = $item['id'];
            //     $detail->qty = $item['qty'];
            //     $detail->harga_satuan = $item['price'];
            //     $detail->subtotal = $item['qty'] * $item['price'];
            //     $detail->save(); // save() digunakan juga di sini
            // }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
