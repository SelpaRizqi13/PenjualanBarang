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
                        <h1>Transaksi Penjualan Barang</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow p-4">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ route('penjualanbarang.store') }}" id="barang-form">
                            @csrf
                            <div class="form-row" id="barang-container">
                                <div class="form-group col-md-8">
                                    <label for="contoh1">Jenis Barang</label>
                                    <select name="jenisbarang_id" class="jenisbarang_id form-control form-select-solid" data-control="select2">
                                        <option value="">--Pilih Jenis Barang--</option>
                                        @foreach ($jenisbarang as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenisbarang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="contoh2">Nama Barang</label>
                                    <select name="barang_id" class="barang_id form-control form-select-solid">
                                        <option value="">--Pilih Barang--</option>
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}" data-stok="{{ $item->stock }}">{{ $item->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="contoh2">Jumlah Barang</label>
                                    <input type="number" class="form-control jumlahyangdibeli" name="jumlahyangdibeli" oninput="validateJumlah(this)">
                                </div>
                            </div>
                            <div class="row mt-5 align-items-right" style="text-align: right">
                                <button type="submit" class="btn btn-primary col-xl-2">Simpan</button>
                                <a class="btn btn-secondary col-xl-2" href="{{ url('penjualanbarang') }}">Batal</a>
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
        var $j = jQuery.noConflict();
        $j(document).ready(function() {
            // Event listener for when the 'jenisbarang' (item type) is changed
            $j(document).on('change', '.jenisbarang_id', function() {
                var jenisbarangId = $j(this).val();
                var barangSelect = $j(this).closest('.form-row').find('.barang_id');

                if (jenisbarangId) {
                    $j.ajax({
                        url: '{{ url("/barang-by-jenisbarang") }}/' + jenisbarangId,
                        type: 'GET',
                        success: function(response) {
                            barangSelect.empty().append('<option value="">--Pilih Barang--</option>');
                            response.forEach(function(barang) {
                                barangSelect.append('<option value="' + barang.id + '" data-stok="' + barang.stock + '">' + barang.nama_barang + '</option>');
                            });
                        }
                    });
                } else {
                    barangSelect.empty().append('<option value="">--Pilih Barang--</option>');
                }
            });

            // Event listener for when the 'barang_id' dropdown value changes
            $j(document).on('change', '.barang_id', function() {
                var selectedOption = $j(this).find('option:selected');
                var stokBarang = selectedOption.data('stok');
                var inputJumlah = $j(this).closest('.form-row').find('.jumlahyangdibeli');
                validateStok(inputJumlah, stokBarang);
            });
        });

        // Function to add a new row
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

        // Function to validate jumlahyangdibeli input to ensure it does not exceed stock
        function validateJumlah(input) {
            var row = input.closest('.form-row');
            var selectedBarang = row.querySelector('.barang_id').selectedOptions[0]; // Get the selected option
            var stokBarang = selectedBarang ? selectedBarang.dataset.stok : 0; // Get the stock from data-stok attribute
            var jumlahYangDibeli = parseInt(input.value);
            if (jumlahYangDibeli > stokBarang) {
                input.setCustomValidity('Jumlah barang tidak boleh melebihi stok. Stock barang yang dipilih tersisa ' + stokBarang);
                input.reportValidity();
            } else {
                input.setCustomValidity('');
            }
        }

        // Function to validate stock when a barang is selected
        function validateStok(input, stokBarang) {
            var jumlahYangDibeli = parseInt(input.val());
            if (jumlahYangDibeli > stokBarang) {
                input[0].setCustomValidity('Jumlah barang tidak boleh melebihi stok.');
                input[0].reportValidity();
            } else {
                input[0].setCustomValidity('');
            }
        }

    </script>
@endpush
