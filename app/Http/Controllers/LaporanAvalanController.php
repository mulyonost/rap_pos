<?php

namespace App\Http\Controllers;

use App\Models\Avalan;
use Illuminate\Http\Request;
use App\Models\PembelianAvalan;
use App\Models\PembelianAvalanDetail;
use Illuminate\Support\Facades\DB;

class LaporanAvalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = PembelianAvalanDetail::selectRaw('pembelian_avalan_detail.id_avalan, sum(qty) as qty, sum(subtotal) as subtotal')
            ->with('avalan')
            ->groupBy('pembelian_avalan_detail.id_avalan')
            ->get()
            ->sortBy(function ($avalan, $key) {
                return $avalan->avalan->nama;
            });

        $pav = PembelianAvalanDetail::with('master.supplier')->with('avalan')->get();
        return view('reports.avalan_index', compact('pav', 'group'));
    }

    public function search(Request $request)
    {
        switch ($request->input('type')) {
            case 'avalan':
                return view('reports.avalan.avalan_item_detail');

            case 'supplier':
                return view('reports.avalan.avalan_group_supplier');

            case 'avalan_group':
                $awal = $request->tanggal_awal;
                $akhir = $request->tanggal_akhir;
                $avalan = Avalan::select('nama', DB::raw('SUM(pembelian_avalan_detail.qty_akhir) as qty, SUM(pembelian_avalan_detail.subtotal) as subtotal'))
                    ->join('pembelian_avalan_detail', 'avalan.id', '=', 'pembelian_avalan_detail.id_avalan')
                    ->join('pembelian_avalan', 'pembelian_avalan.id', '=', 'pembelian_avalan_detail.id_pembelian_avalan')
                    ->whereBetween('pembelian_avalan.tanggal', [$awal, $akhir])
                    ->groupBy('avalan.nama')
                    ->get();
                return view('reports.avalan.avalan_group_avalan_manual', compact('avalan'));
        }
    }

    public function data_avalan(Request $request)
    {
        $avalan = PembelianAvalanDetail::with('master.supplier')->with('avalan')->get();

        return datatables()
            ->of($avalan)
            ->make(true);
    }

    public function data_supplier()
    {
        $avalan = PembelianAvalan::selectRaw('sum(total_nota) as total, id_supplier')
            ->with('supplier')
            ->groupBy('id_supplier')
            ->get();

        return datatables()
            ->of($avalan)
            ->make(true);
    }

    public function data_avalan_group()
    {
        $avalan = PembelianAvalanDetail::selectRaw('pembelian_avalan_detail.id_avalan, sum(qty) as qty, sum(subtotal) as subtotal')
            ->with('avalan')
            ->groupBy('pembelian_avalan_detail.id_avalan')
            ->get()
            ->sortBy(function ($avalan, $key) {
                return $avalan->avalan->nama;
            });

        return datatables()
            ->of($avalan)
            ->make(true);
    }
}
