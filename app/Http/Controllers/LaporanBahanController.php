<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use Illuminate\Http\Request;

class LaporanBahanController extends Controller
{
    public function index()
    {
        $group = PembelianDetail::selectRaw('pembelian_detail.id_item, sum(qty) as qty, sum(subtotal) as subtotal')
            ->with('items')
            ->groupBy('pembelian_detail.id_item')
            ->get()
            ->sortBy(function ($items, $key) {
                return $items->items->nama;
            });

        return view('reports.bahan_index', compact('group'));
    }
}
