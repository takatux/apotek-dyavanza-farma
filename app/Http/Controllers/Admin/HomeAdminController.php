<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Alert;
use App\Models\TransaksiObat;

class HomeAdminController extends Controller
{
    //
    public function index()
    {
        $data = Obat::select('*')->where('status', 'aktif')->get();
        return view('admin.home-admin', compact('data'));
    }

    public function getData()
    {
        $data = Obat::where('status', 'aktif')->orderBy('created_at', 'desc');
        return Datatables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){
                            return 
                            '<a href="'.route('admin-edit', $row->id_obat).'">
                            <i class="bi bi-pen-fill"></i> </a> 
                            <a class="btn-link-danger modal-deletetab1" href="#" data-id="'.$row->id_obat.'">
                            <i class="bi bi-trash-fill" style="color:red"></i> </a>';
                        })
                        ->rawColumns(['aksi'])
                        ->make(true);        
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'  => "required",
            'komposisi' => "required",
            'jenis_produk' => "required",
            'status' => "required",
            'harga' => "required|numeric",
            'stok'  => "required|numeric",
        ]);

        $input = Arr::only($request->all(), [
            'nama',
            'komposisi',
            'jenis_produk',
            'harga',
            'stok',
            'status',
            'image',
        ]);

        $obat = new Obat();
        $result = $obat->create($input);

        if(!empty($input['image'])) 
        {
            $file = $input['image'];
            $filename = "obat_".time() . '.' . $file->getClientOriginalExtension();
            $filePath = base_path("public/assets/img/obat");
            $file->move($filePath, $filename);
            $result->update([
                "image" => $filename
            ]);
        }

        if($result){
            Alert::success('Success!', 'Obat Berhasil Ditambah');
            return redirect()->route('home-admin');
        }
    }

    public function edit($id)
    {
        $data = Obat::where('id_obat', $id)->get();
        return view('admin.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama'  => "required",
            'komposisi' => "required",
            'jenis_produk' => "required",
            'harga' => "required|numeric",
            'stok'  => "required|numeric",
        ]);

        $input = Arr::only($request->all(), [
            'nama',
            'komposisi',
            'jenis_produk',
            'harga',
            'stok',
            'image',
        ]);
        $obat = Obat::where('id_obat', $id)->first();
        $result = $obat->update($input);

        if(!empty($input['image'])) 
        {
            $file = $input['image'];
            $filename = "obat_".time() . '.' . $file->getClientOriginalExtension();
            $filePath = base_path("public/assets/img/obat");
            $file->move($filePath, $filename);
            $obat->update([
                "image" => $filename
            ]);
        }

        if($result){
            Alert::success('Success!', 'Obat Berhasil Diubah');
            return redirect()->route('home-admin');
        }
    }


    public function pesanan()
    {
        return view('admin.pemesanan');
    }

    public function getDataPemesan()
    {
        $data = TransaksiObat::select('*')
                ->join('obat', 'obat.id_obat', '=', 'transaksi_obat.obat_id_obat');
        return Datatables::of($data)->addIndexColumn()
                ->addColumn('aksi', function($row){
                    if($row->validasi != "Berhasil" && $row->validasi != "Gagal"){
                        return 
                        '<button href="#" data-id="'.$row->id.'" class="btn btn-primary modal-tab-acc">
                            <i class="bi bi-check"></i>
                        </button>
                        <button href="#" data-id="'.$row->id.'" class="btn btn-danger modal-tab-decline">
                            <i class="bi bi-x"></i>
                        </button>';
                    }   
                    
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function accPemesanan($id)
    {   
        $transaksi = TransaksiObat::where('id', $id)->first();
        $obat = Obat::where('transaksi_obat.id', $id)->join('transaksi_obat', 'transaksi_obat.obat_id_obat', '=', 'obat.id_obat')->first();
        $stok = $obat->stok;
        $pesanan = $transaksi->jumlah;
        $jumlah = $stok - $pesanan;
        $transaksi->validasi = "Berhasil";
        $transaksi->save();

        $obat->stok = $jumlah;
        $obat->save();

        return redirect('/admin/pesanan');
    }

    public function declinePemesanan($id)
    {   
        $transaksi = TransaksiObat::where('id', $id)->first();
        $transaksi->validasi = "Gagal";
        $transaksi->save();
        return redirect('/admin/pesanan');
    }

    public function delete($id)
    {
        $data = Obat::where('id_obat', $id)->first();
        $data->status = "non-aktif";
        $data->save();
        return redirect('admin/home');
    }
}
