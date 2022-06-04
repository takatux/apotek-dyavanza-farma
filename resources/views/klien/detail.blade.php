@extends('layouts.app')

@section('content')
<section class="page-section">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Detail Obat') }}</div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{route('admin-update',$data[0]->id_obat)}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <img src="{{asset('assets/img/obat/'.$data[0]->image)}}" alt="Foto Obat" style="width: 250px; height: auto; margin-left: auto; margin-right: auto; ">
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data[0]->nama }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="komposisi" class="col-md-4 col-form-label text-md-end">{{ __('Komposisi') }}</label>

                            <div class="col-md-6">
                                <textarea id="komposisi" name="komposisi" class="form-control @error('komposisi') is-invalid @enderror" rows="4" cols="50" disabled>{{$data[0]->komposisi}}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_produk" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Produk') }}</label>

                            <div class="col-md-6">
                                <input id="jenis_produk" type="text" class="form-control @error('jenis_produk') is-invalid @enderror" name="jenis_produk" value="{{ $data[0]->jenis_produk }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">{{ __('Harga') }}</label>

                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" onkeyup="sum();" value="{{ $data[0]->harga }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stok" class="col-md-4 col-form-label text-md-end">{{ __('Stok') }}</label>

                            <div class="col-md-6">
                                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ $data[0]->stok }}" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tablet" class="col-md-4 col-form-label text-md-end">{{ __('Pesan / Tablet') }}</label>

                            <div class="col-md-3">
                                <input id="tablet" type="number" class="form-control @error('tablet') is-invalid @enderror" name="tablet" onkeyup="sum();" value="{{ old('tablet') }}">
                            </div>
                            
                        </div>
                        <div class="row mb-3">
                            <label for="jumlah" class="col-md-4 col-form-label text-md-end">{{ __('Total Harga') }}</label>

                            <div class="col-md-3">
                                <input id="jumlah" type="number" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah">
                            </div>
                            
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</section>
@endsection

<script>
    function sum() {
        var harga = document.getElementById('harga').value;
        var tablet = document.getElementById('tablet').value;
        var result = parseInt(harga) * parseInt(tablet);
        if (!isNaN(result)) {
          document.getElementById('jumlah').value = result;
        }
        else
        {
            document.getElementById('jumlah').value = 0;
        }
    }
</script>
