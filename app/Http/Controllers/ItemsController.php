<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pembelian.items_index');
    }

    public function data()
    {
        $item = Items::orderBy('id', 'desc')->get();
        return datatables()
            ->of($item)
            ->addIndexColumn()
            ->addColumn('aksi', function ($item) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('items.update', $item->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('items.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $items = new Items();
        $items->nama = $request->nama;
        $items->kategori = $request->kategori;
        $items->stok_awal = $request->stok_awal;
        $items->stok_minimum = $request->stok_minimum;
        $items->stok_sekarang = 0;
        $items->harga_beli = $request->harga_beli;
        $items->foto = $request->foto;
        $items->keterangan = $request->keterangan;
        $items->save();

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
        $item = Items::find($id);

        return response()->json($item);
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
        $items = Items::find($id);
        $items->nama = $request->nama;
        $items->kategori = $request->kategori;
        $items->stok_awal = $request->stok_awal;
        $items->stok_minimum = $request->stok_minimum;
        $items->stok_sekarang = 0;
        $items->harga_beli = $request->harga_beli;
        $items->foto = $request->foto;
        $items->keterangan = $request->keterangan;
        $items->update();

        return response('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Items::find($id);
        $items->delete();

        return response()->json('Data berhasil dihapus', 200);
    }
}
