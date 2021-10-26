<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluminium;
use App\Models\Anodizing;
use App\Models\AnodizingDetail;

class AnodizingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Aluminium::where('finishing', '!=', 'MF')->orWhereNull("finishing")->orderBy('nama')->get();
        return view ('laporan.anodizing_index', compact('produk'));
    }

    public function data()
    {
        $anodizing = Anodizing::orderBy('id', 'desc')->get();
        return datatables()
            ->of($anodizing)
            ->addIndexColumn()
            ->addColumn('aksi', function ($anodizing) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('anodizing.update', $anodizing->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('anodizing.destroy', $anodizing->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
        $anodizing = new Anodizing();
        $anodizing->tanggal = $request->tanggal;
        $anodizing->nomor = $request->nomor;
        $anodizing->total_btg = $request->total_btg ;
        $anodizing->total_kg = $request->total_kg ;
        $anodizing->keterangan = $request->keterangan ;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHms') . '.' . $extension;
            $file->move('uploads/laporan/anodizing', $filename);
            $produksi->foto = $filename;
        }
        $anodizing->save();

        $id = $anodizing->id;
        foreach ($request->addmore as $key => $value) {
            $anodizingdetail = new AnodizingDetail();
            $anodizingdetail->id_laporan_anodizing = $id;
            $anodizingdetail->nomor = $request->nomor;
            $anodizingdetail->id_aluminium =$value['nama'];
            $anodizingdetail->qty = $value['qty'];
            $anodizingdetail->berat = $value['berat'];
            $anodizingdetail->save();
        }
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
