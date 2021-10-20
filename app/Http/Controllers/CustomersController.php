<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('penjualan.customers_index');
    }

    public function data()
    {
        $customer = Customers::orderBy('id', 'desc')->get();
        return datatables()
            ->of($customer)
            ->addIndexColumn()
            ->addColumn('aksi', function ($customer) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('customers.update', $customer->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('customers.destroy', $customer->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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
        $customer = new Customers();
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->kontak = $request->kontak;
        $customer->nama_kontak = $request->nama_kontak;
        $customer->keterangan = $request->keterangan;
        $customer->save();

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
        $customer = Customers::find($id);

        return response()->json($customer);
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
        $customer = Customers::find($id);
        $customer->nama = $request->nama;
        $customer->alamat = $request->alamat;
        $customer->kontak = $request->kontak;
        $customer->nama_kontak = $request->nama_kontak;
        $customer->keterangan = $request->keterangan;
        $customer->update();

        return response()->json('Data berhasil diubah', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Customers::find($id);
        $supplier->delete();

        return response(null, 204);
    }
}
