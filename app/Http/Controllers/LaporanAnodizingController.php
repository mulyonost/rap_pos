<?php

namespace App\Http\Controllers;

use App\Models\Aluminium;
use App\Models\Anodizing;
use Illuminate\Http\Request;
use App\Models\AnodizingDetail;
use Illuminate\Support\Facades\DB;


class LaporanAnodizingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('reports.anodizing_index');
    }

    public function index_group()
    {
        return view('reports.anodizing.anodizing_group_aluminium');
    }

    public function data(Request $request)
    {
        $awal = $request->awal;
        $akhir = $request->akhir;
        if ($request->awal == null) {
            $anodizing = Aluminium::select('nama',  DB::raw('SUM(anodizing_detail.qty) as qty, SUM(anodizing_detail.qty * anodizing_detail.berat) as total'))
                ->join('anodizing_detail', 'aluminium.id', '=', 'anodizing_detail.id_aluminium')
                ->join('anodizing', 'anodizing.id', '=', 'anodizing_detail.id_laporan_anodizing')
                ->groupBy('aluminium.nama')
                ->get();
        } else {
            $anodizing = Aluminium::select('nama',  DB::raw('SUM(anodizing_detail.qty) as qty, SUM(anodizing_detail.qty * anodizing_detail.berat) as total'))
                ->join('anodizing_detail', 'aluminium.id', '=', 'anodizing_detail.id_aluminium')
                ->join('anodizing', 'anodizing.id', '=', 'anodizing_detail.id_laporan_anodizing')
                ->whereBetween('anodizing.tanggal', [$awal, $akhir])
                ->groupBy('aluminium.nama')
                ->get();
        }


        return view('reports.anodizing_index', compact('anodizing'));
    }
}
