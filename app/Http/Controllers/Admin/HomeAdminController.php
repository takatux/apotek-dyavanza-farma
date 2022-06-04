<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Alert;

class HomeAdminController extends Controller
{
    //
    public function index()
    {
        $data = Obat::select('*')->get();
        return view('admin.home-admin', compact('data'));
    }

    public function getData()
    {
        $data = Obat::orderBy('created_at', 'desc');
        return Datatables::of($data)->addIndexColumn()
                        ->addColumn('aksi', function($row){
                            return 
                            '<a href="#">
                            <i class="bi bi-pencil-square" style="color:blue"></i> </a> 
                            <a class="btn-link-danger modal-deletetab1" href="#" data-id="'.$row->no_pasien.'">
                            <i class="bi bi-trash" style="color:red"></i> </a>';
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
            'harga' => "required|numeric",
            'stok'  => "required|numeric",
        ]);

        $input = Arr::only($request->all(), [
            'nama',
            'komposisi',
            'jenis_produk',
            'harga',
            'stok',
        ]);

        $obat = new Obat();
        $result = $obat->create($input);

        if($result){
            Alert::success('Success!', 'Obat Berhasil Ditambah');
            return redirect()->route('home-admin');
        }
    }
}
