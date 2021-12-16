<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use App\Models\Aluminium;
use Illuminate\Http\Request;
use App\Models\PackingDetail;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;

class LaporanPackingController extends Controller
{
    public function index()
    {
        $packing = Packing::orderBy('id')->get();
        $packing_detail = PackingDetail::with('aluminium')->get();
        $group = PackingDetail::selectRaw('packing_detail.id_aluminium, sum(qty_colly) as colly, sum(qty_subtotal) as btg')
            ->with('aluminium')
            ->groupBy('packing_detail.id_aluminium')
            ->get()
            ->sortBy(function ($aluminium, $key) {
                return $aluminium->aluminium->nama;
            });

        $groupout = PenjualanDetail::selectRaw('penjualan_detail.id_aluminium, sum(colly) as colly, sum(subtotal) as subtotal, sum(qty) as qty')
            ->with('aluminium')
            ->groupBy('penjualan_detail.id_aluminium')
            ->get()
            ->sortBy(function ($aluminium, $key) {
                return $aluminium->aluminium->nama;
            });

        $stockq = 'SELECT aluminium.id, aluminium.nama, aluminium.harga_jual, ((SELECT IFNULL (SUM(qty_subtotal), 0) FROM packing_detail WHERE id_aluminium = aluminium.id) - (SELECT IFNULL (SUM(qty), 0) FROM penjualan_detail WHERE id_aluminium = aluminium.id)) AS quantity FROM aluminium ORDER BY aluminium.nama';

        $stock = DB::select(DB::raw($stockq));

        return view('reports.packing_index', compact('packing_detail', 'packing', 'group', 'groupout', 'stock'));
    }

    public function show($id)
    {
        $aluminium = Aluminium::find($id);
        $packingdetail = PackingDetail::where('id_aluminium', $id)->with('master')->with('aluminium')->get();
        return view('reports.packing_detail', compact('packingdetail', 'aluminium'));
    }
}
