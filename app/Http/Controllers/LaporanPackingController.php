<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use App\Models\Aluminium;
use Illuminate\Http\Request;
use App\Models\PackingDetail;
use App\Models\PenjualanDetail;

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
        return view('reports.packing_index', compact('packing_detail', 'packing', 'group', 'groupout'));
    }

    public function show($id)
    {
        $aluminium = Aluminium::find($id);
        $packingdetail = PackingDetail::where('id_aluminium', $id)->with('master')->with('aluminium')->get();
        return view('reports.packing_detail', compact('packingdetail', 'aluminium'));
    }
}
