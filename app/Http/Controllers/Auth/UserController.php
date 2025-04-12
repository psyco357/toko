<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\UserModel;
use App\Models\Data\BarangModel;
use App\Models\Data\ReportModel;
use App\Models\Data\TokoModel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        // dd(Hash::make('123'));
        $user = UserModel::where('username', $request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            session(['user' => $user]);
            return redirect()->to('dashboard');
        } else {
            return back()->withErrors(['username' => 'Invalid username or password']);
        }
        // dd($request);
    }
    // Proses logout
    public function logout(Request $request)
    {
        // Auth::logout();
        // dd("sini kah");
        $request->session()->flush();
        return redirect()->to('/');
    }
    public function dashboard()
    {
        // Mengambil data user dari session
        $user = session('user');

        if (!$user) {
            return redirect()->route('login');
        }
        $idtoko = $user->getOriginal('idtoko'); // Mendapatkan idtoko dari session

        // Query untuk mengambil data dengan kondisi where idtoko
        $query = ReportModel::with(['barang', 'toko', 'stok']);

        if ($idtoko && $idtoko != '') {
            // Barang terlaris dari 1 toko
            $sub = ReportModel::select('idtoko', 'idbarang', DB::raw('MAX(created_at) as created_at'), DB::raw('SUM(jual) as total_jual'))
                ->groupBy('idtoko', 'idbarang');

            // Menambahkan kondisi if untuk filter berdasarkan idtoko
            if ($idtoko && $idtoko != '') {
                $sub->where('idtoko', $idtoko); // Jika idtoko ada, filter dengan idtoko tersebut
            }

            // Subquery untuk mendapatkan penjualan maksimal per toko
            $max = DB::table(DB::raw("({$sub->toSql()}) as sub1"))
                ->mergeBindings($sub->getQuery()) // Merge bindings untuk subquery
                ->select('idtoko', DB::raw('MAX(total_jual) as max_jual'))
                ->groupBy('idtoko');

            // Join untuk mendapatkan barang terlaris per toko, beserta created_at
            $data = DB::table(DB::raw("({$sub->toSql()}) as t"))
                ->mergeBindings($sub->getQuery()) // Merge bindings untuk subquery
                ->joinSub($max, 'm', function ($join) {
                    $join->on('t.idtoko', '=', 'm.idtoko')
                        ->on('t.total_jual', '=', 'm.max_jual');
                })
                ->get();

            // Ambil idbarang dan idtoko yang unik untuk relasi
            $barangIds = $data->pluck('idbarang')->unique()->values();
            $tokoIds = $data->pluck('idtoko')->unique()->values();

            // Load relasi barang dan toko
            $barangs = BarangModel::whereIn('id', $barangIds)->get()->keyBy('id');
            $tokos = TokoModel::whereIn('id', $tokoIds)->get()->keyBy('id');

            // Mapping data untuk setiap item, memasukkan relasi barang dan toko, serta created_at
            $data = $data->map(function ($item) use ($barangs, $tokos) {
                $item = (object) $item;
                $item->barang = $barangs[$item->idbarang] ?? null;
                $item->toko = $tokos[$item->idtoko] ?? null;
                return $item;
            });
        } else {
            // Subquery untuk menghitung total penjualan per toko dan barang, tanpa mengelompokkan berdasarkan `created_at`
            $sub = ReportModel::select('idtoko', 'idbarang', DB::raw('MAX(created_at) as created_at'), DB::raw('SUM(jual) as total_jual'))
                ->groupBy('idtoko', 'idbarang'); // Tidak perlu group by `created_at`

            // Subquery untuk mendapatkan penjualan maksimal per toko
            $max = DB::table(DB::raw("({$sub->toSql()}) as sub1"))
                ->mergeBindings($sub->getQuery()) // Merge bindings untuk subquery
                ->select('idtoko', DB::raw('MAX(total_jual) as max_jual'))
                ->groupBy('idtoko');

            // Join untuk mendapatkan barang terlaris per toko, beserta `created_at`
            $data = DB::table(DB::raw("({$sub->toSql()}) as t"))
                ->mergeBindings($sub->getQuery()) // Merge bindings untuk subquery
                ->joinSub($max, 'm', function ($join) {
                    $join->on('t.idtoko', '=', 'm.idtoko')
                        ->on('t.total_jual', '=', 'm.max_jual');
                })
                ->get();

            // Ambil idbarang dan idtoko yang unik untuk relasi
            $barangIds = $data->pluck('idbarang')->unique()->values();
            $tokoIds = $data->pluck('idtoko')->unique()->values();

            // Load relasi barang dan toko
            $barangs = BarangModel::whereIn('id', $barangIds)->get()->keyBy('id');
            $tokos = TokoModel::whereIn('id', $tokoIds)->get()->keyBy('id');

            // Mapping data untuk setiap item, memasukkan relasi barang dan toko, serta `created_at`
            $data = $data->map(function ($item) use ($barangs, $tokos) {
                $item = (object) $item;
                $item->barang = $barangs[$item->idbarang] ?? null;
                $item->toko = $tokos[$item->idtoko] ?? null;
                return $item;
            });
        }

        return view('konten.dashboard', compact(['user', 'data']));
    }
}
