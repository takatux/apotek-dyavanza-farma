@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{asset('css/home-admin.css')}}">

{{-- Data Tables --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{asset('css/table.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

@section('content')
<section class="page-section">
    <div class="content">
        <table id="table-obat" class="display table-obat" style="width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Validasi</th>
                    <th>Konfirmasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->jumlah}}</td>
                    <td>{{$item->total_harga}}</td>
                    <td>{{$item->validasi}}</td>
                    <td><a href="https://wa.me/+6285291483888" target="_blank">Confirm</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>     
    </div>
</section>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

