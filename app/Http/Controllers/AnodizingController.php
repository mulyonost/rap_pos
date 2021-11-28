<?php

namespace App\Http\Controllers;

use App\Models\Aluminium;
use App\Models\Anodizing;
use Illuminate\Http\Request;
use App\Models\AnodizingDetail;
use Illuminate\Support\Facades\File;

class AnodizingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Aluminium::where('finishing', '!=', 'MF')->orWhereNull("finishing")->orderBy('nama')->get();
        return view('laporan.anodizing_index', compact('produk'));
    }

    public function data()
    {
        $anodizing = Anodizing::orderBy('id', 'desc')->get();
        return datatables()
            ->of($anodizing)
            ->addIndexColumn()
            ->addColumn('aksi', function ($anodizing) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('laporan_anodizing.update', $anodizing->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('laporan_anodizing.destroy', $anodizing->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $anodizing = new Anodizing();
        $anodizing->tanggal = $request->tanggal;
        $anodizing->nomor = $request->nomor;
        $anodizing->total_btg = $request->total_btg;
        $anodizing->total_kg = $request->total_kg;
        $anodizing->keterangan = $request->keterangan;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->nomor . '-' . date('YmdHms') . '.' . $extension;
            $file->move('uploads/laporan/anodizing', $filename);
            $anodizing->foto = $filename;
        }
        $anodizing->save();

        $id = $anodizing->id;
        foreach ($request->addmore as $key => $value) {
            $anodizingdetail = new AnodizingDetail();
            $anodizingdetail->id_laporan_anodizing = $id;
            $anodizingdetail->id_aluminium = $value['nama'];
            $anodizingdetail->qty = $value['qty'];
            $anodizingdetail->berat = $value['berat'];
            $anodizingdetail->save();
        }

        return redirect('laporan/anodizing');
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
        $data['anodizing'] = Anodizing::find($id);
        $data['anodizingdetail'] = AnodizingDetail::where('id_laporan_anodizing', $id)->with('aluminium')->get();

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
        $anodizing = Anodizing::find($id);
        $anodizing->tanggal = $request->tanggal;
        $anodizing->nomor = $request->nomor;
        $anodizing->total_btg = $request->total_btg;
        $anodizing->total_kg = $request->total_kg;
        $anodizing->keterangan = $request->keterangan;
        if ($request->hasFile('foto')) {
            $anodizing_image = public_path("uploads/laporan/anodizing/{$anodizing->foto}");
            if (File::exists($anodizing_image)) {
                File::delete($anodizing_image);
            };
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = $request->nomor . '-' . date('YmdHms') . '.' . $extension;
            $file->move('uploads/laporan/anodizing', $filename);
            $anodizing->foto = $filename;
        }
        $anodizing->save();

        $id = $anodizing->id;
        foreach ($request->addmore as $key => $value) {
            $anodizingdetail = AnodizingDetail::findOrNew($value['id']);
            $anodizingdetail->id_aluminium = $value['nama'];
            $anodizingdetail->qty = $value['qty'];
            $anodizingdetail->berat = $value['berat'];
            $anodizingdetail->save();
        }

        return redirect('laporan/anodizing');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anodizing = Anodizing::find($id);
        $anodizing_image = public_path("uploads/laporan/anodizing/{$anodizing->foto}");
        $new_location = public_path('/uploads/trash');
        if (File::exists($anodizing_image)) {
            File::delete($anodizing_image);
        };
        $anodizing->delete();
        return response()->json('Data berhasil dihapus', 200);
    }
}
