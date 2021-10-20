<?php

namespace App\Http\Controllers;

use App\Models\Avalan;
use Illuminate\Http\Request;

class AvalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pembelian.avalan_index');
    }

    public function data()
    {
        $avalan = Avalan::orderBy('id', 'desc')->get();
        return datatables()
            ->of($avalan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($avalan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('avalan.update', $avalan->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('avalan.destroy', $avalan->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $avalan = new Avalan;
        $avalan->nama = $request->nama;
        $avalan->harga = $request->harga;
        $avalan->id_supplier = 1;

        $avalan->save();
        return response('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $avalan = Avalan::find($id);

        return response()->json($avalan);
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
        $avalan = Avalan::find($id);

        $avalan->nama = $request->nama;
        $avalan->harga = $request->harga;
        $avalan->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $avalan = Avalan::find($id);
        $avalan->delete();

        return response()->json('Data berhasil dihapus', 200);
    }
}
