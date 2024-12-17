@extends('layouts.app')

@section('content')
    <div class="header pb-8 pt-5 pt-md-8">
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
                        <h1>Tambah Master Barang</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow p-4">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ route('barang.store') }}" id="barang-form">
                            @csrf
                            <div class="form-row" id="barang-container">
                                <div class="form-group col-md-4">
                                    <label for="contoh1">Jenis Barang</label>
                                    <select name="jenisbarang_id[]" id="jenisbarang_id" data-control="select2" class="form-control form-select-solid">
                                        <option value="">--Pilih Jenis Barang--</option>
                                        @foreach ($jenisbarang as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenisbarang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="contoh2">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang[]" id="nama_barang" placeholder="Nama Barang">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="contoh2">Stock</label>
                                    <input type="number" class="form-control" name="stock[]" id="stock">
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-center justify-content-center">
                                    <i class="fa fa-plus-circle" onclick="addRow()" style="font-size: 28px; cursor: pointer;"></i>
                                </div>
                            </div>
                            <div class="row mt-5 align-items-right" style="text-align: right">
                                <button type="submit" class="btn btn-primary col-xl-2">Simpan</button>
                                <a class="btn btn-secondary col-xl-2" href="{{ url('barang') }}">Batal</a>
                            </div>
                        </form>
                        <div id="row-template" style="display: none;">
                            <div class="col-xl-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="contoh1">Jenis Barang</label>
                                        <select name="jenisbarang_id[]" class="form-control form-select-solid">
                                            <option value="">--Pilih Jenis Barang--</option>
                                            @foreach ($jenisbarang as $jenis)
                                                <option value="{{ $jenis->id }}">{{ $jenis->nama_jenisbarang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="contoh2">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama_barang[]" placeholder="Nama Barang">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="contoh2">Stock</label>
                                        <input type="number" class="form-control" name="stock[]">
                                    </div>
                                    <div class="form-group col-md-1 d-flex align-items-center justify-content-center">
                                        <i class="fa fa-trash remove-row add-row" onclick="removeRow(this)" style="font-size: 28px; cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        function addRow() {
            var container = document.getElementById('barang-container');
            if (container) {
                var newRow = document.getElementById('row-template').innerHTML;
                container.insertAdjacentHTML('beforeend', newRow);
            } else {
                console.error("Barang container not found!");
            }
        }

        // Function to remove a row
        function removeRow(element) {
            const row = element.closest('.form-row');
            if (row) {
                row.remove(); // Remove the row
            } else {
                console.error('Row element not found!');
            }
        }

        // Function to clear the form
        function clearForm() {
            // Get all the rows inside the container
            var container = document.getElementById('barang-container');
            if (container) {
                var rows = container.getElementsByClassName('form-row');
                // Loop through each row and remove it
                while (rows.length > 0) {
                    rows[0].remove();
                }
            } else {
                console.error('Barang container not found!');
            }
        }
    </script>
@endpush
