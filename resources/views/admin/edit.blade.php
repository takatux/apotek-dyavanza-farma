@extends('layouts.app')

@section('content')
<section class="page-section">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ubah Data Obat') }}</div>
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
                            
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Change Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autocomplete="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $data[0]->nama }}" required autocomplete="nama">

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="komposisi" class="col-md-4 col-form-label text-md-end">{{ __('Komposisi') }}</label>

                            <div class="col-md-6">
                                <textarea id="komposisi" name="komposisi" class="form-control @error('komposisi') is-invalid @enderror" rows="4" cols="50" required autocomplete="komposisi">{{$data[0]->komposisi}}</textarea>
                                @error('komposisi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jenis_produk" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Produk') }}</label>

                            <div class="col-md-6">
                                <select name="jenis_produk" id="jenis_produk" class="form-control @error('no_telephone') is-invalid @enderror" >
                                    <option value="{{$data[0]->jenis_produk}}" selected="false">{{$data[0]->jenis_produk}}</option> 
                                    <option value="Tablet">Tablet</option>
                                    <option value="Kapsul">Kapsul</option>
                                    <option value="Kaplet">Kaplet</option>
                                    <option value="Pil">Pil</option>
                                    <option value="Serbuk atau puyer">Serbuk atau puyer</option>
                                    <option value="Suppositoria">Suppositoria</option>
                                    <option value="Obat oles">Obat oles</option>
                                    <option value="Obat cair ">Obat cair </option>
                                    <option value="Suspensi">Suspensi</option>
                                    <option value="Injeksi">Injeksi</option>
                                    <option value="Obat tetes">Obat tetes</option>
                                    <option value="Inhaler">Inhaler</option>
                                </select>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">{{ __('Harga') }}</label>

                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ $data[0]->harga }}" required autocomplete="harga">

                                @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stok" class="col-md-4 col-form-label text-md-end">{{ __('Stok') }}</label>

                            <div class="col-md-6">
                                <input id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ $data[0]->stok }}" required autocomplete="stok">

                                @error('stok')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
