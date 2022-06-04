<?php

namespace App\Http\Controllers\Klien;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Alert;
use App\Models\TransaksiObat;
use Auth;

class HomeKlienController extends Controller
{
    //
    public function index()
    {
        $data = Obat::select('*')->where('status', 'aktif')->get();
        return view('klien.home', compact('data'));
    }

    public function getData()
    {
        $data = Obat::where('status', 'aktif')->orderBy('created_at', 'desc');
        return Datatables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){
                            return 
                            '<a href="'.route('klien-detail', $row->id_obat).'">
                            <i class="bi bi-archive-fill"></i>Detail </a>';
                        })
                        ->rawColumns(['aksi'])
                        ->make(true);        
    }
    public function show($id)
    {
        $data = Obat::where('id_obat', $id)->get();
        return view('klien.detail', compact('data'));
    }

    public function pemesanan(Request $request, $id)
    {

        if(empty($request->tablet))
        {
            return back()->with('error', 'Pemesanan Tablet Harus Di Isi');
        }
        
        if($request->tablet > $request->stok)
        {
            return back()->with('error', 'Pemesanan Tablet Melebihi Stok');
        }

        $transaksi = new TransaksiObat();
        $transaksi->users_username = Auth::user()->username;
        $transaksi->obat_id_obat = $id;
        $transaksi->jumlah = $request->tablet;
        $transaksi->total_harga = $request->jumlah;
        $transaksi->validasi = "Menunggu";
        $transaksi->save();

        Alert::success('Success!', 'Pemesanan Sedang Di Proses');
        return redirect()->route('home-klien');
    }

    public function keranjang()
    {
        $data = TransaksiObat::join('obat', 'obat.id_obat', '=', 'transaksi_obat.obat_id_obat')
                    ->where('transaksi_obat.users_username', Auth::user()->username)->get();
        return view('klien.keranjang', compact('data'));
    }
}
