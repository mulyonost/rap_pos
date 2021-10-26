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
    {
        $produk = Aluminium::where('finishing', "MF")->orderBy("nama")->get();
        $nomor = date('Ymd');
        return view('laporan.produksi_index', compact('produk', 'nomor'));
    }

    public function data()
    {
        $produksi = Produksi::orderBy('id', 'desc')->get();
        return datatables()
            ->of($produksi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($produksi) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('produksi.update', $produksi->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('produksi.destroy', $produksi->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $produksi = new Produksi();
        $produksi->nomor_laporan = $request->nomor;
        $produksi->tanggal = $request->tanggal;
        $produksi->anggota = $request->anggota;
        $produksi->mesin = $request->mesin;
        $produksi->shift = $request->shift;
        $produksi->total_produksi = $request->total;
        $produksi->jumlah_billet = $request->jumlah_billet;
        $produksi->jumlah_avalan = $request->jumlah_avalan;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHms') . '.' . $extension;
            $file->move('uploads/laporan/produksi', $filename);
            $produksi->foto = $filename;
        }
        $produksi->save();


        $id = $produksi->id;
        foreach ($request->addmore as $key => $value) {
            $produksidetail = new ProduksiDetail();
            $produksidetail->id_laporan_produksi = $id;
            $produksidetail->nomor_laporan = $request->nomor;
            $produksidetail->no_matras = $value['matras'];
            $produksidetail->id_aluminium = $value['nama'];
            $produksidetail->berat = $value['berat'];
            $produksidetail->qty = $value['qty'];
            $produksidetail->total = $value['subtotal'];
            $produksidetail->save();
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
        // $data = array();
        // $data['produksi'] = Produksi::find($id);
        // $data['produksidetail'] = ProduksiDetail::where('id_laporan_produksi', $id)->get();

        $data = Produksi::find($id);
        $detail = ProduksiDetail::where('id_laporan_produksi', $id)->get();

        return response()->json($data);
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
