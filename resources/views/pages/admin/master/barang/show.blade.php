@extends('layouts.app')

@section('content')
    <div class="header pb-8 pt-5 pt-md-8" style="background: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)">
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
                        <h1>Detail Barang</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <a class="btn btn-success" href="/barang">  Kembali</a>
                        <div class="row mt-4 ms-4">
                            <div class="col-xl-12">
                                <label for="" class="fw-bold">Jenis Barang </label><br>
                                <span>{{ $model->jenisbarang->nama_jenisbarang }}</span>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <label for="" class="fw-bold">Nama Barang </label><br>
                                <span>{{ $model->nama_barang }}</span>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <label for="" class="fw-bold">Stock Barang </label><br>
                                <span>{{ $model->stock }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush