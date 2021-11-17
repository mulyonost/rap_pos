<?php

namespace App\Http\Controllers;

use App\Models\Avalan;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Models\AvalanSupplier;
use App\Models\PembelianAvalan;

class PembelianAvalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Suppliers::where('kategori', 'avalan')->orderBy('nama')->get();
        $avalan = Avalan::orderBy('nama')->get();
        return view('pembelian.pembelian_avalan_index', compact('supplier', 'avalan'));
    }

    public function data()
    {
        $pembelianav = PembelianAvalan::orderBy('id', 'desc')->get();
        return datatables()
            ->of($pembelianav)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pembelianav) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('pembe$pembelianav.update', $pembelianav->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('pembe$pembelianav.destroy', $pembelianav->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $pembelianav = new PembelianAvalan;
        $pembelianav->nomor = $request->nomor;
        $pembelianav->tanggal = $request->tanggal;
        $pembelianav->due_date = $request->due_date;
        $pembelianav->id_supplier = $request->supplier;
        $pembelianav->total_nota = $request->total_nota;
        $pembelianav->diskon = $request->diskon;
        $pembelianav->total_akhir = $request->diskon;
        $pembelianav->foto_nota = $request->foto;
        $pembelianav->status = $request->status;
        $pembelianav->keterangan = $request->keterangan;
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
