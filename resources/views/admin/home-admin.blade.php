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
        <a onclick="window.location.href='{{route('admin-create')}}'" class="appointment-btn scrollto" style="color: white">Tambah Obat</a>
        <table id="table-obat" class="display table-obat" style="width: 100%;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Obat</th>
                    <th>Jenis Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr></tr>
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

<script type="text/javascript">
    $(document).ready(function(){

    fetch_data();

    function fetch_data(search='')
    {
        $('.table-obat').DataTable({

            language: {
                searchPlaceholder: 'Search...',
                sEmptyTable:   'Tidak ada data yang tersedia pada tabel ini',
                sProcessing:   'Sedang memproses...',
                // sLengthMenu:   'Tampilkan _MENU_ entri',
                sZeroRecords:  'Tidak ditemukan data yang sesuai',
                sInfo:         'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
                sInfoEmpty:    'Menampilkan 0 sampai 0 dari 0 entri',
                sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
                sInfoPostFix:  '',
                sSearch:       '',
                sUrl:          '',
                oPaginate: {
                sFirst:    'Pertama',
                sPrevious: 'Sebelumnya',
                sNext:     'Selanjutnya',
                sLast:     'Terakhir'
                }
            },
            paging: true,
            // responsive: false,
            // processing: true,
            scrollX: true,
            // filter : false,
            lengthChange: false,

            ajax: {

            url:"{{ route('admin-getData') }}",

            data: {
                search : search,
            }

            },
            columns:[
                    {data: 'id_obat',
                        render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'nama', name: 'nama'},
                    {data: 'jenis_produk', name: 'jenis_produk'},
                    {data: 'harga', name: 'harga'},
                    {data: 'stok', name: 'stok'},
                    {data: 'aksi', name: 'aksi'},
            ]

            });

        }

        $("body").on("click", ".modal-deletetab1", function() {
            var judulid = $(this).attr('data-id');
            swal({
                title: "Yakin?",
                text: "kamu akan menghapus data ini ?",
                icon: "warning",
                buttons: ["Batal", "OK"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/admin/delete/"+judulid+"" 
                    swal("Data berhasil dihapus", {
                    icon: "success",
                    });
                } else {
                    swal("Data Tidak Jadi dihapus");
                }
                });
        });
    });
</script>
