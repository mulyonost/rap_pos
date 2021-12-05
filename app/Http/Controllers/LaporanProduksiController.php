<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Aluminium;
use Illuminate\Http\Request;
use App\Models\AluminiumBase;
use App\Models\ProduksiDetail;
use Illuminate\Support\Facades\DB;


class LaporanProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $produksi = Produksi::orderBy('id')->get();
        // $produksi_detail = ProduksiDetail::with('aluminium')->get();
        // $group = ProduksiDetail::selectRaw('laporan_produksi_detail.id_aluminium, sum(qty * berat) as total, sum(qty) as qty, min(berat) as berat_min, max(berat) as berat_max')
        //     ->with('aluminium')
        //     ->groupBy('laporan_produksi_detail.id_aluminium')
        //     ->get()
        //     ->sortBy(function($aluminium, $key){
        //         return $aluminium->aluminium->nama;
        //     });
        // $tanggal = ProduksiDetail::with('master')->get();
        // return view ('reports.produksi_index', compact('produksi_detail', 'produksi', 'group', 'tanggal'));
        // $produksis = Produksi::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
        //     ->with('detail')
        //     ->get();
        // $produksi = ProduksiDetail::selectRaw('laporan_produksi_detail.id_aluminium, sum(qty * berat) as total, sum(qty) as qty, min(berat) as berat_min, max(berat) as berat_max')
        //     ->groupBy('laporan_produksi_detail.id_aluminium')
        //     ->get()
        //     ->sortBy(function ($aluminium, $key) {
        //         return $aluminium->aluminium->nama;
        //     });


        $tanggalAwal = date('Y-m-01');
        $tanggalAkhir = date('Y-m-d');

        $count = Produksi::selectRaw('count(produksi.tanggal) as count')
            ->distinct()
            ->whereBetween('produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->get();

        $produksi = AluminiumBase::select('nama', DB::raw('SUM(produksi_detail.qty) as qty, SUM(produksi_detail.qty * produksi_detail.berat) as total, min(produksi_detail.berat) as berat_min, max(produksi_detail.berat) as berat_max'))
            ->join('produksi_detail', 'aluminium_base.id', '=', 'produksi_detail.id_aluminium_base')
            ->join('produksi', 'produksi.id', '=', 'produksi_detail.id_laporan_produksi')
            ->whereBetween('produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('aluminium_base.nama')
            ->get();

        return view('reports.produksi_index', compact('tanggalAwal', 'tanggalAkhir', 'produksi', 'count'));
    }

    public function date(Request $request)
    {
        switch ($request->input('button')) {
            case 'date':
                $tanggalAwal = $request->tanggal_awal;
                $tanggalAkhir = $request->tanggal_akhir;
                $count = Produksi::selectRaw('count(produksi.tanggal) as count')
                    ->distinct()
                    ->whereBetween('produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
                    ->get();

                $produksi = AluminiumBase::select('nama', DB::raw('SUM(produksi_detail.qty) as qty, SUM(produksi_detail.qty * produksi_detail.berat) as total, min(produksi_detail.berat) as berat_min, max(produksi_detail.berat) as berat_max'))
                    ->join('produksi_detail', 'aluminium_base.id', '=', 'produksi_detail.id_aluminium_base')
                    ->join('produksi', 'produksi.id', '=', 'produksi_detail.id_laporan_produksi')
                    ->whereBetween('produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
                    ->groupBy('aluminium_base.nama')
                    ->get();

                return view('reports.produksi_index', compact('tanggalAwal', 'tanggalAkhir', 'produksi', 'count'));
                break;

            case 'all':
                $count = Produksi::selectRaw('count(produksi.tanggal) as count')
                    ->distinct()
                    ->get();

                $produksi = AluminiumBase::select('nama', DB::raw('SUM(produksi_detail.qty) as qty, SUM(produksi_detail.qty * produksi_detail.berat) as total, min(produksi_detail.berat) as berat_min, max(produksi_detail.berat) as berat_max'))
                    ->join('produksi_detail', 'aluminium_base.id', '=', 'produksi_detail.id_aluminium_base')
                    ->join('produksi', 'produksi.id', '=', 'produksi_detail.id_laporan_produksi')
                    ->groupBy('aluminium_base.nama')
                    ->get();

                return view('reports.produksi_index', compact('produksi', 'count'));
                break;
        }
    }

    public function search(Request $request)
    {


        $awal = $request->awal;
        $akhir = $request->akhir;
        if ($request->awal == null) {
            $produksi = AluminiumBase::select('nama',  DB::raw('SUM(produksi_detail.qty) as qty, SUM(produksi_detail.qty * produksi_detail.berat) as total, min(produksi_detail.berat) as berat_min, max(produksi_detail.berat) as berat_max'))
                ->join('produksi_detail', 'aluminium_base.id', '=', 'produksi_detail.id_aluminium_base')
                ->join('produksi', 'produksi.id', '=', 'produksi_detail.id_laporan_produksi')
                ->groupBy('aluminium_base.nama')
                ->get();
        } else {
            $produksi = AluminiumBase::select('nama',  DB::raw('SUM(produksi_detail.qty) as qty, SUM(produksi_detail.qty * produksi_detail.berat) as total, min(produksi_detail.berat) as berat_min, max(produksi_detail.berat) as berat_max'))
                ->join('produksi_detail', 'aluminium_base.id', '=', 'produksi_detail.id_aluminium_base')
                ->join('produksi', 'produksi.id', '=', 'produksi_detail.id_laporan_produksi')
                ->whereBetween('produksi.tanggal', [$awal, $akhir])
                ->groupBy('aluminium_base.nama')
                ->get();
        }


        return view('reports.produksi_index', compact('produksi'));
    }
}
