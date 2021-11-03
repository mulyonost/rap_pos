<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Aluminium;
use App\Models\AluminiumBase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AluminiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alma = Aluminium::orderBy('id')->get();
        $base = AluminiumBase::orderBy('nama')->get();
        return view('penjualan.aluminium_index', compact('alma', 'base'));
    }

    public function data()
    {
        $aluminium = Aluminium::orderBy('nama')->get();
        return datatables()
            ->of($aluminium)
            ->addIndexColumn()
            ->addColumn('aksi', function ($aluminium) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('aluminium.update', $aluminium->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('aluminium.destroy', $aluminium->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $aluminium = new Aluminium();
        $aluminium->base_id = $request->base;
        $aluminium->nama = $request->nama;
        $aluminium->base_name = Str::slug(substr($request->nama, 0, -3), '-');
        $aluminium->finishing = $request->finishing;
        $aluminium->kategori = $request->kategori;
        $aluminium->berat_maksimal = $request->berat_maksimal;
        $aluminium->stok_awal = $request->stok_awal;
        $aluminium->stok_minimum = $request->stok_minimum;
        $aluminium->stok_sekarang = 0;
        $aluminium->berat_jual = $request->berat_jual;
        $aluminium->harga_jual = $request->harga_jual;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama) . '.' . $extension;
            $file->move('uploads/aluminium/', $filename);
            $aluminium->foto = $filename;
        }
        $aluminium->keterangan = $request->keterangan;
        $aluminium->save();



        return view('penjualan.aluminium_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluminium = Aluminium::find($id);

        return response()->json($aluminium);
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
        $aluminium = Aluminium::find($id);
        $aluminium->nama = $request->nama;
        $aluminium->base_name = Str::slug(substr($request->nama, 0, -3), '-');
        $aluminium->finishing = $request->finishing;
        $aluminium->kategori = $request->kategori;
        $aluminium->berat_maksimal = $request->berat_maksimal;
        $aluminium->stok_awal = $request->stok_awal;
        $aluminium->stok_minimum = $request->stok_minimum;
        $aluminium->berat_jual = $request->berat_jual;
        $aluminium->harga_jual = $request->harga_jual;
        if ($request->hasFile('foto')) {
            $aluminium_image = public_path("uploads/aluminium/{$aluminium->foto}");
            if (File::exists($aluminium_image)) {
                File::delete($aluminium_image);
            };
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama) . '.' . $extension;
            $file->move('uploads/aluminium/', $filename);
            $aluminium->foto = $filename;
        }
        $aluminium->keterangan = $request->keterangan;
        $aluminium->update();

        return view('penjualan.aluminium_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluminium = Aluminium::find($id);
        $aluminium_image = public_path("uploads/aluminium/{$aluminium->foto}");
        if (File::exists($aluminium_image)) {
            File::delete($aluminium_image);
        };
        $aluminium->delete();

        return response()->json('Data berhasil dihapus', 200);
    }
}
