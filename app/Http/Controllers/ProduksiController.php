<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\ProduksiDetail;
use App\Models\Aluminium;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $produk = Aluminium::orderBy('id')->get();
        $id_laporan = date('Y-m-d');

        return view('laporan.produksi_index', compact('produk', 'id_laporan'));
    }

    public function data()
    {
        $produksi = Produksi::orderBy('id_laporan_produksi', 'desc')->get();
        return datatables()
            ->of($produksi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($produksi) {
                // return '
                // <div class="btn-group">
                //     <button onclick="editForm(`' . route('produksi.update', $produksi->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                //     <button onclick="deleteData(`' . route('produksi.destroy', $produksi->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
                // </div>
                // ';
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
        $produksi = new Produksi();
        $produksi->id_laporan_produksi = $request->id_laporan;
        $produksi->tanggal = $request->tanggal;
        $produksi->anggota = $request->anggota;
        $produksi->mesin = $request->mesin;
        $produksi->shift = $request->shift;
        $produksi->total_produksi = $request->total;
        $produksi->jumlah_billet = $request->jumlah_billet;
        $produksi->jumlah_avalan = $request->jumlah_avalan;
        $produksi->foto = $request->foto;
        $produksi->save();

        foreach ($request->addmore as $key => $value) {
            $produksidetail = new ProduksiDetail();
            $produksidetail->id_laporan_produksi = $request->id_laporan;
            $produksidetail->no_matras = $value['matras'];
            $produksidetail->id_aluminium = $value['nama'];
            $produksidetail->berat = $value['berat'];
            $produksidetail->qty = $value['qty'];
            $produksidetail->total = $value['subtotal'];
            $produksidetail->save();
        }
        return redirect('laporan.produksi_index');
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
