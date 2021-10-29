<?php

namespace App\Http\Controllers;

use App\Models\Packing;
use App\Models\Aluminium;
use App\Models\PackingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Aluminium::orderBy('nama')->get();
        return view('laporan.packing_index', compact('produk'));
    }

    public function data()
    {
        $packing = Packing::orderBy('id', 'desc')->get();
        return datatables()
            ->of($packing)
            ->addIndexColumn()
            ->addColumn('aksi', function ($packing) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('packing.update', $packing->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('packing.destroy', $packing->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $packing = new Packing();
        $packing->tanggal = $request->tanggal;
        $packing->nomor = $request->nomor;
        $packing->total_btg = $request->total_btg;
        $packing->total_colly = $request->total_colly;
        $packing->total_cacat = $request->total_cacat;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHms') . '.' . $extension;
            $file->move('uploads/laporan/packing', $filename);
            $packing->foto = $filename;
        }
        $packing->keterangan = $request->keterangan;
        $packing->save();

        $id = $packing->id;
        foreach ($request->addmore as $key => $value) {
            $packingdetail = new PackingDetail();
            $packingdetail->id_laporan_packing = $id;
            $packingdetail->nomor = $request->nomor;
            $packingdetail->id_aluminium = $value['nama'];
            $packingdetail->qty_colly = $value['qty'];
            $packingdetail->qty_isi = $value['berat'];
            $packingdetail->qty_subtotal = $value['subtotal'];
            $packingdetail->save();
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
        $packing = Packing::find($id);
        $packing_image = public_path("uploads/packing/{$packing->foto}");
        if (File::exists($packing_image)) {
            File::delete($packing_image);
        };
        $packing->delete();

        return response()->json('Data berhasil dihapus', 200);
    }
}