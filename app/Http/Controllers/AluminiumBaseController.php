<?php

namespace App\Http\Controllers;

use App\Models\AluminiumBase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AluminiumBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aluminium = AluminiumBase::orderBy('nama')->get();
        return view('laporan.aluminium_base_index', compact('aluminium'));
    }

    public function data()
    {
        $aluminium = AluminiumBase::orderBy('nama')->get();
        return datatables()
            ->of($aluminium)
            ->addIndexColumn()
            ->addColumn('aksi', function ($aluminium) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('aluminiumbase.update', $aluminium->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('aluminiumbase.destroy', $aluminium->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $aluminiumbase = new AluminiumBase;
        $aluminiumbase->nama = $request->nama;
        $aluminiumbase->berat_avg = $request->berat_avg;
        $aluminiumbase->berat_maksimal = $request->berat_maksimal;
        $aluminiumbase->stok_awal = $request->stok_awal;
        $aluminiumbase->stok_minimum = $request->stok_minimum;
        $aluminiumbase->stok_sekarang = $request->stok_sekarang;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama) . '.' . $extension;
            $file->move('uploads/aluminium/', $filename);
            $aluminiumbase->foto = $filename;
        }
        $aluminiumbase->keterangan = $request->keterangan;
        $aluminiumbase->save();

        return view('laporan.aluminium_base_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AluminiumBase  $aluminiumBase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluminium = AluminiumBase::find($id);

        return response()->json($aluminium);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AluminiumBase  $aluminiumBase
     * @return \Illuminate\Http\Response
     */
    public function edit(AluminiumBase $aluminiumBase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AluminiumBase  $aluminiumBase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $aluminiumbase = AluminiumBase::find($id);
        $aluminiumbase->nama = $request->nama;
        $aluminiumbase->berat_avg = $request->berat_avg;
        $aluminiumbase->berat_maksimal = $request->berat_maksimal;
        $aluminiumbase->stok_awal = $request->stok_awal;
        $aluminiumbase->stok_minimum = $request->stok_minimum;
        $aluminiumbase->stok_sekarang = $request->stok_sekarang;
        if ($request->hasFile('foto')) {
            $aluminium_image = public_path("uploads/aluminium/{$aluminiumbase->foto}");
            if (File::exists($aluminium_image)) {
                File::delete($aluminium_image);
            };
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama) . '.' . $extension;
            $file->move('uploads/aluminium/', $filename);
            $aluminiumbase->foto = $filename;
        }
        $aluminiumbase->keterangan = $request->keterangan;
        $aluminiumbase->save();

        return view('laporan.aluminium_base_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AluminiumBase  $aluminiumBase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluminiumbase = AluminiumBase::find($id);
        $aluminium_image = public_path("uploads/aluminium/{$aluminiumbase->foto}");
        if (File::exists($aluminium_image)) {
            File::delete($aluminium_image);
        };
        $aluminiumbase->delete();
        return response()->json('Data berhasil dihapus', 200);
    }
}
