<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        $penjualan = PenjualanDetail::with('master.customer')->with('aluminium')->get();
        return view('reports.penjualan.penjualan_index', compact('penjualan'));
        return view('reports.penjualan.penjualan_index', compact('penjualan'));
    }

    public function search(Request $request)
    {

        if ($request->group == "none") {

            $penjualan = PenjualanDetail::with('master.customer')->with('aluminium')->get();
            return view('reports.penjualan.penjualan_index', compact('penjualan'));
        } else if ($request->group == "item") {
            echo "This is item group";
        } else {
            echo "This is customers group";
        }
    }

    public function data()
    {
        $penjualan = PenjualanDetail::with('aluminium', 'master.customer')->whereHas('master', function ($query) {
            // $tanggal = '2021-10-02';
            // return $query->where('tanggal', $tanggal);
        });

        return datatables()
            ->of($penjualan)
            ->make(true);
    }
}
