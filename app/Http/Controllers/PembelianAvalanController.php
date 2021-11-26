<?php

namespace App\Http\Controllers;

use App\Models\Avalan;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Models\AvalanSupplier;
use App\Models\PembelianAvalan;
use App\Models\PembelianAvalanDetail;
use Illuminate\Support\Str;

class PembelianAvalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Suppliers::where('kategori', 'avalan')->orderBy('nama')->get();
        $avalan = Avalan::orderBy('nama')->get();
        return view('pembelian.pembelian_avalan_index', compact('supplier', 'avalan'));
    }

    public function data()
    {
        $pembelianav = PembelianAvalan::orderBy('id', 'desc')->where('status', 0)->with('supplier')->get();
        return datatables()
            ->of($pembelianav)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pembelianav) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('pembelian_avalan.update', $pembelianav->id) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></buttom>
                    <button onclick="deleteData(`' . route('pembelian_avalan.destroy', $pembelianav->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></buttom>
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

        $pembelianav = new PembelianAvalan;
        $pembelianav->nomor = $request->nomor;
        $pembelianav->tanggal = $request->tanggal;
        $pembelianav->due_date = $request->due_date;
        $pembelianav->id_supplier = $request->supplier;
        $pembelianav->total_nota = $request->total;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama_supp) . '-' . $request->tanggal . '-' . date('YmdHms') . '.' . $extension;
            $file->move('uploads/pembelian/avalan', $filename);
            $pembelianav->foto_nota = $filename;
        }
        $pembelianav->status = $request->status;
        $pembelianav->keterangan = $request->keterangan;
        $pembelianav->created_by = auth()->user()->name;
        $pembelianav->save();

        $id = $pembelianav->id;
        foreach ($request->addmore as $key => $value) {
            $pembelianavdetail = new PembelianAvalanDetail;
            $pembelianavdetail->id_pembelian_avalan = $id;
            $pembelianavdetail->id_avalan = $value['item'];
            $pembelianavdetail->qty = $value['qty'];
            $pembelianavdetail->potongan = $value['potongan'];
            $pembelianavdetail->qty_akhir = $value['qty_akhir'];
            $pembelianavdetail->harga = $value['harga'];
            $pembelianavdetail->subtotal = $value['subtotal'];
            $pembelianavdetail->save();
        }
        session(['id_pembelian_avalan' => $id]);

        return redirect('pembelian/avalan');
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
        $data['pembelianav'] = PembelianAvalan::find($id);
        $data['pembelianavdetail'] = PembelianAvalanDetail::where('id_pembelian_avalan', $id)->with('avalan')->get();

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
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelianav = PembelianAvalan::find($id);
        $pembelianav->delete();
    }

    public function payment(Request $request)
    {
        $payment = PembelianAvalan::find($request->id_pembelian_avalan);
        $payment->tanggal_bayar = $request->tanggal_pembayaran;
        $payment->keterangan_bayar = $request->keterangan_pembayaran;
        $payment->status = 1;
        $payment->save();

        return redirect('pembelian/avalan');
    }

    public function cetak()
    {
        $pembelianav = PembelianAvalan::with('supplier')->find(session('id_pembelian_avalan'));
        $pembelianavdetail = PembelianAvalanDetail::where('id_pembelian_avalan', session('id_pembelian_avalan'))->with('avalan')->get();

        return view('pembelian.pembelian_avalan_nota', compact('pembelianav', 'pembelianavdetail'));
    }

    public function cetakulang($id)
    {
        $pembelianav = PembelianAvalan::with('supplier')->find($id);
        $pembelianavdetail = PembelianAvalanDetail::where('id_pembelian_avalan', $id)->with('avalan')->get();

        return view('pembelian.pembelian_avalan_nota', compact('pembelianav', 'pembelianavdetail'));
    }
}
