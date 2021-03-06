<?php

namespace App\Http\Controllers;

use App\Models\Aluminium;
use App\Models\Customers;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanPaid;
use App\Models\PenjualanDetail;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aluminium = Aluminium::orderBy('nama')->get();
        $customer = Customers::orderBy('nama')->get();
        return view('penjualan.penjualan_index', compact('aluminium', 'customer'));
    }

    public function index_pelunasan()
    {
        return view('penjualan.penjualan_pelunasan_index');
    }

    public function data()
    {
        $penjualan = Penjualan::orderBy('tanggal', 'desc')->with('customer')->get();
        return datatables()
            ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('penjualan_aluminium.update', $penjualan->id) . '`)" class="btn btn-xs btn-primary btn-flat"><i class="far fa-eye"></i></button>
                    <a href="/penjualan/aluminium/' . $penjualan->id . '/edit" class="btn btn-xs btn-warning btn-flat"><i class="far fa-edit"></i></a>
                    <button onclick="deleteData(`' . route('penjualan_aluminium.destroy', $penjualan->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pelunasan()
    {
        $penjualan = Penjualan::orderBy('tanggal', 'desc')->with('customer')->where('status', 0)->get();
        return datatables()
            ->of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('penjualan_aluminium.update', $penjualan->id) . '`)" class="btn btn-xs btn-primary btn-flat"><i class="far fa-eye"></i></button>
                    <a href="/penjualan/aluminium/' . $penjualan->id . '/edit" class="btn btn-xs btn-warning btn-flat"><i class="far fa-edit"></i></a>
                    <button onclick="deleteData(`' . route('penjualan_aluminium.destroy', $penjualan->id) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $customers = Customers::orderBy('nama')->get();
        $aluminium = Aluminium::orderBy('nama')->get();
        return view('penjualan.penjualan_create', compact('customers', 'aluminium'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penjualan = new Penjualan();
        $penjualan->nomor = $request->nomor;
        $penjualan->id_customer = $request->customer;
        $penjualan->timbangan_mobil = $request->timbangan;
        // $penjualan->foto_mobil = $request->foto_mobil;
        // $penjualan->foto_nota = $request->foto_nota;
        $penjualan->tanggal = $request->tanggal;
        $penjualan->due_date = $request->due_date;
        $penjualan->status = $request->status;
        $penjualan->keterangan = $request->keterangan;
        $penjualan->total_nota = $request->total_nota;
        $penjualan->diskon = $request->diskon_rupiah;
        $penjualan->total_akhir = $request->total_akhir;
        $penjualan->created_by = auth()->user()->name;
        $penjualan->save();

        $id = $penjualan->id;

        session(['id_penjualan' => $id]);
        foreach ($request->addmore as $key => $value) {
            $penjualandetail = new PenjualanDetail();
            $penjualandetail->id_penjualan = $id;
            $penjualandetail->id_aluminium = $value['nama'];
            $penjualandetail->colly = $value['colly'];
            $penjualandetail->isi = $value['isi'];
            $penjualandetail->qty = $value['qty'];
            $penjualandetail->unit = "btg";
            $penjualandetail->harga = $value['harga'];
            $penjualandetail->subtotal = $value['subtotal'];
            $penjualandetail->save();
        }

        return redirect('penjualan/aluminium/selesai');
    }

    public function selesai()
    {
        return view('penjualan.penjualan_selesai');
    }

    public function cetaksj()
    {
        $id_penjualan = session('id_penjualan');
        $penjualan = Penjualan::with('customer')->find($id_penjualan);
        $penjualandetail = PenjualanDetail::where('id_penjualan', $id_penjualan)->with('aluminium')->get();

        return view('penjualan.penjualan_sj', compact('penjualan', 'penjualandetail'));
    }


    public function cetaknota()
    {
        $id_penjualan = session('id_penjualan');
        $penjualan = Penjualan::with('customer')->find($id_penjualan);
        $penjualandetail = PenjualanDetail::where('id_penjualan', $id_penjualan)->with('aluminium')->get();

        return view('penjualan.penjualan_nota', compact('penjualan', 'penjualandetail'));
    }

    public function cetakulangsj($id)
    {
        $penjualan = Penjualan::with('customer')->find($id);
        $penjualandetail = PenjualanDetail::where('id_penjualan', $id)->with('aluminium')->get();

        return view('penjualan.penjualan_sj', compact('penjualan', 'penjualandetail'));
    }

    public function cetakulangnota($id)
    {
        $penjualan = Penjualan::with('customer')->find($id);
        $penjualandetail = PenjualanDetail::where('id_penjualan', $id)->with('aluminium')->get();

        return view('penjualan.penjualan_nota', compact('penjualan', 'penjualandetail'));
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
        $data['penjualan'] = Penjualan::with('customer')->find($id);
        $data['penjualandetail'] = PenjualanDetail::where('id_penjualan', $id)->with('aluminium')->get();
        $data['payment'] = PenjualanPaid::where('id_penjualan', $id)->get();

        return response()->json($data);
    }

    public function showpayment($id)
    {
        $data = array();
        $data['payment'] = PenjualanPaid::where('id_penjualan', $id)->get();

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

        $customers = Customers::orderBy('nama')->get();
        $aluminium = Aluminium::orderBy('nama')->get();
        $penjualan = Penjualan::find($id);
        $penjualandetail = PenjualanDetail::where('id_penjualan', $id)->get();
        return view('penjualan.penjualan_edit', compact('customers', 'aluminium', 'penjualan', 'penjualandetail'));
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
        $penjualan = Penjualan::find($id);
        $penjualan->nomor = $request->nomor;
        $penjualan->id_customer = $request->customer;
        $penjualan->timbangan_mobil = $request->timbangan;
        $penjualan->tanggal = $request->tanggal;
        $penjualan->due_date = $request->due_date;
        $penjualan->status = $request->status;
        $penjualan->keterangan = $request->keterangan;
        $penjualan->total_nota = $request->total_nota;
        $penjualan->diskon = $request->diskon_rupiah;
        $penjualan->total_akhir = $request->total_akhir;
        $penjualan->created_by = auth()->user()->name;
        $penjualan->save();

        PenjualanDetail::where('id_penjualan', $id)->delete();

        foreach ($request->addmore as $key => $value) {
            $penjualandetail = new PenjualanDetail();
            $penjualandetail->id_penjualan = $id;
            $penjualandetail->id_aluminium = $value['nama'];
            $penjualandetail->colly = $value['colly'];
            $penjualandetail->isi = $value['isi'];
            $penjualandetail->qty = $value['qty'];
            $penjualandetail->unit = "btg";
            $penjualandetail->harga = $value['harga'];
            $penjualandetail->subtotal = $value['subtotal'];
            $penjualandetail->save();
        }

        return redirect('penjualan/aluminium');
    }

    public function payment(Request $request)
    {
        $pdtl = Penjualan::find($request->id_penjualan);
        foreach ($request->addmore as $key => $value) {
            $payment = new PenjualanPaid;
            $payment->id_penjualan = $request->id_penjualan;
            $payment->bank = $value['bank'];
            $payment->tanggal = $value['tanggal'];
            $payment->jumlah = $value['jumlah'];
            $payment->keterangan = $value['keterangan'];
            $payment->save();
        }
        if ($request->sisa == 0) {
            $pdtl->status = 1;
        }
        $pdtl->save();

        return redirect('penjualan/aluminium/pelunasan');
    }

    public function paymentDelete($id)
    {
        $payment = PenjualanPaid::where('id_penjualan', $id);
        $penjualan = Penjualan::find($id);
        $penjualan->status = 0;
        $penjualan->update();
        $payment->delete();

        return redirect('penjualan/aluminium');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);
        $penjualan->delete();
        return response()->json('Data berhasil dihapus', 200);
    }
}
