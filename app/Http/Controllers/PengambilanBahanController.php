<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\PengambilanBahan;
use App\Models\PengambilanBahanDetail;
use Illuminate\Http\Request;

class PengambilanBahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Items::orderBy('nama')->get();
        return view('laporan.pengambilan_bahan_index', compact('item'));
    }


    public function data()
    {
        $pengambilan = PengambilanBahan::orderBy('id', 'desc')->get();
        return datatables()
            ->of($pengambilan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pengambilan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('pengambilan.update', $pengambilan->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('pengambilan.destroy', $pengambilan->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $pengambilan = new PengambilanBahan();
        $pengambilan->nomor = $request->nomor;
        $pengambilan->tanggal = $request->tanggal;
        $pengambilan->divisi = $request->divisi;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->nomor . date('YmdHms') . '.' . $extension;
            $file->move('uploads/laporan/pengambilan', $filename);
            $pengambilan->foto = $filename;
        }
        $pengambilan->keterangan = $request->keterangan;
        $pengambilan->save();

        $id = $pengambilan->id;
        foreach ($request->addmore as $key => $value) {
            $pengambilandetail = new PengambilanBahanDetail();
            $pengambilandetail->id_pengambilan_bahan = $id;
            $pengambilandetail->id_item = $value['item'];
            $pengambilandetail->qty = $value['qty'];
            $pengambilandetail->save();
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
        $pengambilan = PengambilanBahan::find($id);
        // $pengambilan_image = public_path("uploads/laporan/produksi/{$pengambilan->foto}");
        // if (File::exists($pengambilan_image)) {
        //     File::delete($pengambilan_image);
        // };
        $pengambilan->delete();
        return response()->json('Data berhasil dihapus', 200);
    }
}
