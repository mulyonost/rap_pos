<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Pembelian;
use App\Models\Suppliers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PembelianDetail;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Items::orderBy('nama')->get();
        $supplier = Suppliers::where('kategori', 'umum')->orderBy('nama')->get();
        return view('pembelian.pembelian_index', compact('item', 'supplier'));
    }

    public function data()
    {
        $pembelian = Pembelian::orderBy('id', 'desc')->with('supplier')->get();
        return datatables()
            ->of($pembelian)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pembelian) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('pembelian_bahan.update', $pembelian->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('pembelian_bahan.destroy', $pembelian->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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

        $pembelian = new Pembelian();
        $pembelian->nomor = $request->nomor;
        $pembelian->id_supplier = $request->supplier;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->due_date = $request->due_date;
        $pembelian->status = $request->status;
        $pembelian->foto = $request->foto_nota;
        $pembelian->total = $request->total_nota;
        $pembelian->keterangan = $request->keterangan;
        if ($request->hasFile('foto_nota')) {
            $file = $request->file('foto_nota');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama_supp) . '-' . $request->tanggal . '-' . date('YmdHms') . '.' . $extension;
            $file->move('uploads/pembelian/bahan', $filename);
            $pembelian->foto = $filename;
        }
        $pembelian->save();

        $id_pembelian = $pembelian->id;

        foreach ($request->addmore as $key => $value) {
            $pembeliandetail = new PembelianDetail();
            $pembeliandetail->id_pembelian = $id_pembelian;
            $pembeliandetail->id_item = $value['nama'];
            $pembeliandetail->qty = $value['qty'];
            $pembeliandetail->harga = $value['harga'];
            $pembeliandetail->subtotal = $value['subtotal'];
            $pembeliandetail->save();
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
        $data['pembelian'] = Pembelian::find($id);
        $data['pembeliandetail'] = PembelianDetail::where('id_pembelian', $id)->with('items')->get();

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
        $pembelian = Pembelian::find($id);
        $pembelian->delete();
    }
}
