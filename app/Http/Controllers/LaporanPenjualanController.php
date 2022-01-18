<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanDetail;

class LaporanPenjualanController extends Controller
{
    public function index()
    {

        return view('reports.penjualan.penjualan_index');
    }

    public function search(Request $request)
    {
        // dd($request);

        if ($request->group == "none") {

            $penjualan = PenjualanDetail::with('master.customer')->with('aluminium')->get();
            // dd($penjualan[0]);
            return view('reports.penjualan.penjualan_index', compact('penjualan'));
        } else if ($request->group == "item") {
            echo "This is item group";
        } else {
            echo "This is customers group";
        }
    }
}
