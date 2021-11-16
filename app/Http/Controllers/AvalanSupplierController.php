<?php

namespace App\Http\Controllers;

use App\Models\Avalan;
use App\Models\AvalanSupplier;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class AvalanSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Suppliers::orderBy('nama')->get();
        $avalan = Avalan::orderBy('nama')->get();
        return view('master.avalan_supplier_index', compact('supplier', 'avalan'));
    }

    public function data()
    {
        $avsup = AvalanSupplier::orderBy('id', 'desc')->with('supplier')->with('avalan')->get();
        return datatables()
            ->of($avsup)
            ->addIndexColumn()
            ->addColumn('aksi', function ($avsup) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('master_avalansupplier.update', $avsup->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('master_avalansupplier.destroy', $avsup->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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

        $supplier = $request->supplier;

        foreach ($request->addmore as $key => $value) {
            $avsup = new AvalanSupplier();
            $avsup->id_supplier = $supplier;
            $avsup->id_avalan = $value['nama'];
            $avsup->harga = $value['harga'];
            $avsup->save();
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
