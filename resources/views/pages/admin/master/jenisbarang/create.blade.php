@extends('layouts.app')

@section('content')
    <div class="header  pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                
            </div>
        </div>
    </div>
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Tambah Jenis Barang</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow p-4">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ route('jenisbarang.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="contoh2">Nama Jenis Barang</label>
                                    <input type="text" class="form-control" name="nama_jenisbarang" id="nama_jenisbarang" placeholder="Nama Jenis Barang">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="contoh2">Deskripsi Jenis Barang</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mt-5 align-items-right" style="text-align: right">
                                <button type="submit" class="btn btn-primary col-xl-2">Simpan</button>
                                <a class="btn btn-secondary col-xl-2" href="{{ url('jenisbarang') }}">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#jenisbarang_id').select2({
                theme: 'bootstrap-5'
            });
        });

        

    </script>
@endpush