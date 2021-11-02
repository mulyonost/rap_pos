<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\Aluminium;
use Illuminate\Http\Request;
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

        $produksi = Aluminium::select('nama', DB::raw('SUM(produksi_detail.qty) as qty, SUM(produksi_detail.qty * produksi_detail.berat) as total, min(produksi_detail.berat) as berat_min, max(produksi_detail.berat) as berat_max'))
            ->join('produksi_detail', 'aluminium.id', '=', 'produksi_detail.id_aluminium')
            ->join('produksi', 'produksi.id', '=', 'produksi_detail.id_laporan_produksi')
            ->whereBetween('produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
            ->groupBy('aluminium.nama')
            ->get();

        return view('reports.produksi_index', compact('tanggalAwal', 'tanggalAkhir', 'produksi', 'count'));
    }

    public function date(Request $request)
    {
        switch ($request->input('button')) {
            case 'date':
                $tanggalAwal = $request->tanggal_awal;
                $tanggalAkhir = $request->tanggal_akhir;
                $count = Produksi::selectRaw('count(laporan_produksi.tanggal) as count')
                    ->distinct()
                    ->whereBetween('laporan_produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
                    ->get();

                $produksi = Aluminium::select('nama', DB::raw('SUM(laporan_produksi_detail.qty) as qty, SUM(laporan_produksi_detail.qty * laporan_produksi_detail.berat) as total, min(laporan_produksi_detail.berat) as berat_min, max(laporan_produksi_detail.berat) as berat_max'))
                    ->join('laporan_produksi_detail', 'aluminium.id', '=', 'laporan_produksi_detail.id_aluminium')
                    ->join('laporan_produksi', 'laporan_produksi.id', '=', 'laporan_produksi_detail.id_laporan_produksi')
                    ->whereBetween('laporan_produksi.tanggal', [$tanggalAwal, $tanggalAkhir])
                    ->groupBy('aluminium.nama')
                    ->get();

                return view('reports.produksi_index', compact('tanggalAwal', 'tanggalAkhir', 'produksi', 'count'));
                break;

            case 'all':
                $count = Produksi::selectRaw('count(laporan_produksi.tanggal) as count')
                    ->distinct()
                    ->get();

                $produksi = Aluminium::select('nama', DB::raw('SUM(laporan_produksi_detail.qty) as qty, SUM(laporan_produksi_detail.qty * laporan_produksi_detail.berat) as total, min(laporan_produksi_detail.berat) as berat_min, max(laporan_produksi_detail.berat) as berat_max'))
                    ->join('laporan_produksi_detail', 'aluminium.id', '=', 'laporan_produksi_detail.id_aluminium')
                    ->join('laporan_produksi', 'laporan_produksi.id', '=', 'laporan_produksi_detail.id_laporan_produksi')
                    ->groupBy('aluminium.nama')
                    ->get();

                return view('reports.produksi_index', compact('produksi', 'count'));
                break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
