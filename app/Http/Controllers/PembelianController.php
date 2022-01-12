<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Pembelian;
use App\Models\Suppliers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PembelianDetail;
use Illuminate\Support\Facades\File;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Items::orderBy('nama')->get();
        $supplier = Suppliers::where('kategori', 'avalan')->where('kategori', 'avalan')->orderBy('nama')->get();
        return view('pembelian.bahan.pembelian_index', compact('item', 'supplier'));
    }

    public function index_pelunasan()
    {
        $item = Items::orderBy('nama')->get();
        $supplier = Suppliers::where('kategori', 'avalan')->where('kategori', 'avalan')->orderBy('nama')->get();
        return view('pembelian.bahan.pembelian_pelunasan_index', compact('item', 'supplier'));
    }

    public function data()
    {
        $pembelian = Pembelian::orderBy('tanggal', 'desc')->with('supplier')->take(50)->get();
        return datatables()
            ->of($pembelian)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pembelian) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('pembelian_bahan.update', $pembelian->id) . '`)" class="btn btn-xs btn-primary btn-flat" id="edit"><i class="far fa-eye"></i></button>
                    <a href="/pembelian/bahan/' . $pembelian->id . '/edit" class="btn btn-xs btn-warning btn-flat"><i class="far fa-edit"></i></a>
                    <button onclick="deleteData(`' . route('pembelian_bahan.destroy', $pembelian->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pelunasan()
    {
        $pembelian = Pembelian::orderBy('tanggal', 'desc')->where('status', 0)->with('supplier')->get();
        return datatables()
            ->of($pembelian)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pembelian) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('pembelian_bahan.update', $pembelian->id) . '`)" class="btn btn-xs btn-primary btn-flat"><i class="far fa-eye"></i></button>
                    <a href="/pembelian/bahan/' . $pembelian->id . '/edit" class="btn btn-xs btn-warning btn-flat"><i class="far fa-edit"></i></a>
                    <button onclick="deleteData(`' . route('pembelian_bahan.destroy', $pembelian->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $suppliers = Suppliers::orderBy('nama')->get();
        $items = Items::orderBy('nama')->get();
        return view('pembelian.bahan.pembelian_bahan_create', compact('suppliers', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $pembelian = new Pembelian();
        $pembelian->nomor = $request->nomor;
        $pembelian->id_supplier = $request->supplier;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->due_date = $request->due_date;
        $pembelian->status = $request->status;
        $pembelian->total = $request->total_nota;
        $pembelian->keterangan = $request->keterangan;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama_supp) . '-' . $request->tanggal . '-' . date('YmdHms') . '.' . $extension;
            $file->move('uploads/pembelian/bahan', $filename);
            $pembelian->foto = $filename;
        }
        $pembelian->save();

        $id_pembelian = $pembelian->id;

        foreach ($request->addmore as $key => $value) {
            $pembeliandetail = new PembelianDetail();
            $pembeliandetail->id_pembelian = $id_pembelian;
            $pembeliandetail->id_item = $value['nama'];
            $pembeliandetail->qty = $value['qty'];
            $pembeliandetail->harga = $value['harga'];
            $pembeliandetail->subtotal = $value['subtotal'];
            $pembeliandetail->save();
        }

        return redirect('pembelian/bahan');
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
        $data['pembelian'] = Pembelian::with('supplier')->find($id);
        $data['pembeliandetail'] = PembelianDetail::where('id_pembelian', $id)->with('items')->get();

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
        $suppliers = Suppliers::orderBy('nama')->get();
        $items = Items::orderBy('nama')->get();
        $pbl = Pembelian::find($id);
        $pbld = PembelianDetail::where('id_pembelian', $id)->get();

        return view('pembelian.bahan.pembelian_bahan_edit', compact('suppliers', 'items', 'pbl', 'pbld'));
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
        $pembelian = Pembelian::find($id);
        $pembelian->nomor = $request->nomor;
        $pembelian->id_supplier = $request->supplier;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->due_date = $request->due_date;
        $pembelian->status = $request->status;
        $pembelian->total = $request->total_nota;
        $pembelian->keterangan = $request->keterangan;
        if ($request->hasFile('foto')) {
            $image = public_path("uploads/pembelian/bahan/{$pembelian->foto}");
            if (File::exists($image)) {
                File::delete($image);
            };
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama_supp) . '-' . $request->tanggal . '-' . date('YmdHms') . '.' . $extension;
            $file->move('uploads/pembelian/bahan', $filename);
            $pembelian->foto = $filename;
        }
        $pembelian->save();

        PembelianDetail::where('id_pembelian', $id)->delete();

        foreach ($request->addmore as $key => $value) {
            $pembeliandetail = new PembelianDetail();
            $pembeliandetail->id_pembelian = $id;
            $pembeliandetail->id_item = $value['nama'];
            $pembeliandetail->qty = $value['qty'];
            $pembeliandetail->harga = $value['harga'];
            $pembeliandetail->subtotal = $value['subtotal'];
            $pembeliandetail->save();
        }

        return redirect('pembelian/bahan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::find($id);
        $pembelian->delete();
    }

    public function payment(Request $request)
    {
        $payment = Pembelian::find($request->id_pembelian);
        $payment->tanggal_bayar = $request->tanggal_pembayaran;
        $payment->keterangan_bayar = $request->keterangan_pembayaran;
        $payment->status = 1;
        $payment->save();

        return redirect('pembelian/bahan/pelunasan');
    }

    public function paymentDelete($id)
    {
        $payment = Pembelian::find($id);
        $payment->tanggal_bayar = null;
        $payment->keterangan_bayar = null;
        $payment->status = 0;
        $payment->save();
        return redirect('pembelian/bahan');
    }
}
