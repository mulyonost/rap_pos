<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.items_index');
    }

    public function data()
    {
        $item = Items::orderBy('nama', 'desc')->get();
        return datatables()
            ->of($item)
            ->addIndexColumn()
            ->addColumn('aksi', function ($item) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('master_items.update', $item->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('master_items.destroy', $item->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        // dd($request);
        $items = new Items;
        $items->nama = $request->nama;
        $items->unit = $request->unit;
        $items->kategori = $request->kategori;
        $items->stok_awal = $request->stok_awal;
        $items->stok_minimum = $request->stok_minimum;
        $items->stok_sekarang = 0;
        $items->harga = $request->harga;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama) . '.' . $extension;
            $file->move('uploads/items/', $filename);
            $items->foto = $filename;
        }
        $items->keterangan = $request->keterangan;
        $items->save();

        return redirect('master/items');
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
        $items->unit = $request->unit;
        $items->kategori = $request->kategori;
        $items->stok_awal = $request->stok_awal;
        $items->stok_minimum = $request->stok_minimum;
        $items->stok_sekarang = 0;
        $items->harga = $request->harga;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama) . '.' . $extension;
            $file->move('uploads/items/', $filename);
            $items->foto = $filename;
        }
        $items->keterangan = $request->keterangan;
        $items->update();

        return redirect('master/items');
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
        $item_image = public_path("uploads/items/{$items->foto}");
        if (File::exists($item_image)) {
            File::delete($item_image);
        };
        $items->delete();

        return response()->json('Data berhasil dihapus', 200);
    }
}
