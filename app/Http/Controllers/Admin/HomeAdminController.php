<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    //
    public function index()
    {
        $data = Obat::select('*')->get();
        return view('admin.home-admin', compact('data'));
    }
}
