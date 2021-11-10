<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluminium;
use App\Models\Customers;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aluminium = Aluminium::orderBy('nama')->get();
        $customer = Customers::orderBy('nama')->get();
        return view('penjualan.penjualan_index', compact('aluminium', 'customer'));
    }


    public function data()
    {
        $penjualan = Penjualan::orderBy('tanggal')->with('customer')->get();
        return datatables()
            ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('sale.update', $penjualan->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('sale.destroy', $penjualan->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $penjualan = new Penjualan();
        $penjualan->nomor = $request->nomor;
        $penjualan->id_customer = $request->customer;
        $penjualan->timbangan_mobil = $request->timbangan;
        // $penjualan->foto_mobil = $request->foto_mobil;
        // $penjualan->foto_nota = $request->foto_nota;
        $penjualan->tanggal = $request->tanggal;
        $penjualan->due_date = $request->due_date;
        $penjualan->status = $request->status;
        $penjualan->keterangan = $request->keterangan;
        $penjualan->total_nota = $request->total_nota;
        $penjualan->diskon = $request->diskon_rupiah;
        $penjualan->total_akhir = $request->total_akhir;
        $penjualan->save();

        $id = $penjualan->id;
        foreach ($request->addmore as $key => $value) {
            $penjualandetail = new PenjualanDetail();
            $penjualandetail->id_penjualan = $id;
            $penjualandetail->id_aluminium = $value['nama'];
            $penjualandetail->colly = $value['colly'];
            $penjualandetail->isi = $value['isi'];
            $penjualandetail->qty = $value['qty'];
            $penjualandetail->unit = "btg";
            $penjualandetail->harga = $value['harga'];
            $penjualandetail->subtotal = $value['subtotal'];
            $penjualandetail->save();
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
        $data = array();
        $data['penjualan'] = Penjualan::find($id);
        $data['penjualandetail'] = PenjualanDetail::where('id_penjualan', $id)->with('aluminium')->get();

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
        $penjualan = Penjualan::find($id);
        $penjualan->delete();
        return response()->json('Data berhasil dihapus', 200);
    }
}
