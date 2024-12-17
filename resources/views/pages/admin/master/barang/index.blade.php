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
                        <h1>Master Barang</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            @if (Session::has('success'))
                            <div class="col-xl-12">
                                <p class="alert alert-success mt-4 " style="font-weight: bold">{{ Session::get('success') }}</p>
                            </div>
                            @endif
                            <div class="col">
                                <h3 class="mb-0">Daftar Barang</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ url('barang/create') }}" class="btn btn-primary"><i class="fa fa-plus me-2"></i> Tambah Barang</a>
                            </div>
                        </div>
                    </div>
                    <div class="p-3">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stock Barang</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1;
                                @endphp
                                @foreach ($model as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->jenisbarang->nama_jenisbarang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm" href="{{ url('barang/' . $item->id) }}"><i
                                                    class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-success btn-sm" href="{{ url('barang/' . $item->id . '/edit') }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm delete" data-id="{{ $item->id }}" type="submit"> <i
                                                    class="fa fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>                
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
        $('.delete').click(function() {
            var barang = $(this).attr('data-id');
            Swal.fire({
                title: "Yakin?",
                text: "Apakah yakin akan menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "delete_barang/" + barang + "";
                    Swal.fire(
                        "Data berhasil dihapus",
                        {
                            icon: "success",
                        }
                    );
                } else {
                    Swal.fire("Data tidak jadi dihapus");
                }
            });
        });
    </script>
@endpush