<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anodizing;
use App\Models\AnodizingDetail;


class LaporanAnodizingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anodizing = Anodizing::orderBy('id')->get();
        $anodizing_detail = AnodizingDetail::with('aluminium')->get();
        $group = AnodizingDetail::selectRaw('anodizing_detail.id_aluminium, sum(qty * berat) as total, sum(qty) as qty')
            ->with('aluminium')
            ->groupBy('anodizing_detail.id_aluminium')
            ->get()
            ->sortBy(function($aluminium, $key){
                return $aluminium->aluminium->nama;
            });
        return view ('reports.anodizing_index', compact('anodizing_detail', 'anodizing', 'group'));
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
