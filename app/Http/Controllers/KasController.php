<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use App\Models\KasDetail;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view ('kas.index');
    }

    public function data()
    {
        $kas = Kas::orderBy('id', 'desc')->get();
        return datatables()
            ->of($kas)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kas) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('kas.update', $kas->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('kas.destroy', $kas->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $kas = new Kas();
        $kas->id = $request->id_kas;
        $kas->tanggal = $request->tanggal;
        $kas->total = $request->total;
        $kas->save();
        
        foreach ($request->addmore as $key=>$value) {
            $kasdetail = new KasDetail();
            $kasdetail->id_kas = $request->id_kas;
            $kasdetail->nama = $value['nama'];
            $kasdetail->qty = $value['qty'];
            $kasdetail->harga = $value['harga'];
            $kasdetail->subtotal = $value['subtotal'];
            $kasdetail->kategori = $value['kategori'];
            $kasdetail->save();
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
        //
    }
}
