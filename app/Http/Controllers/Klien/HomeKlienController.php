<?php

namespace App\Http\Controllers\Klien;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yajra\DataTables\DataTables;
use Alert;

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
}
