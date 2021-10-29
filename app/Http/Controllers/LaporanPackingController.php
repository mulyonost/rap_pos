<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Packing;
use App\Models\PackingDetail;

class LaporanPackingController extends Controller
{
    public function index()
    {
        $packing = Packing::orderBy('id')->get();
        $packing_detail = PackingDetail::with('aluminium')->get();
        $group = PackingDetail::selectRaw('laporan_packing_detail.id_aluminium, sum(qty_colly) as colly, sum(qty_subtotal) as btg')
            ->with('aluminium')
            ->groupBy('laporan_packing_detail.id_aluminium')
            ->get()
            ->sortBy(function($aluminium, $key){
                return $aluminium->aluminium->nama;
            });
        return view ('reports.packing_index', compact('packing_detail', 'packing', 'group'));
    }
    }

