<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class LaporanPenjualanController extends Controller
{
    public function index()
    {
        return view('reports.penjualan.penjualan_items_detail');
    }

    public function search(Request $request)
    {
        switch ($request->input('type')) {
            case 'item':
                return view('reports.penjualan.penjualan_items_detail');

            case 'customer':
                return view('reports.penjualan.penjualan_group_customer');

            case 'items':
                return view('reports.penjualan.penjualan_group_items');
        }

        // if ($request->group == "none") {

        //     $penjualan = PenjualanDetail::with('master.customer')->with('aluminium')->get();
        //     return view('reports.penjualan.penjualan_index', compact('penjualan'));
        // } else if ($request->group == "item") {
        //     echo "This is item group";
        // } else {
        //     echo "This is customers group";
        // }
    }

    public function data_items()
    {
        $penjualan = PenjualanDetail::with('aluminium', 'master.customer')->whereHas('master', function ($query) {
            // $tanggal_awal = '2021-10-01';
            // $tanggal_akhir = '2021-10-30';
            // return $query->whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir]);
        });

        return datatables()
            ->of($penjualan)
            ->make(true);
    }

    public function customer()
    {
        return view('reports.penjualan.penjualan_group_customer');
    }

    public function data_customer()
    {
        $penjualan = Penjualan::selectRaw('sum(total_akhir) as total_penjualan, id_customer')
            ->with('customer')
            ->groupBy('id_customer')
            ->get();

        return datatables()
            ->of($penjualan)
            ->make(true);
    }

    public function items()
    {
        return view('reports.penjualan.penjualan_group_items');
    }

    public function data_items_group()
    {
        $penjualan = PenjualanDetail::selectRaw('sum(qty) as total_qty, sum(subtotal) as subtotal,  id_aluminium')
            ->with('aluminium')
            ->groupBy('id_aluminium')
            ->get();

        return datatables()
            ->of($penjualan)
            ->make(true);
    }
}
