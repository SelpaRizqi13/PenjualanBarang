@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 mb-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h1>Report Penjualan Barang</h1>
                    <div class="">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Jenis Barang Terbanyak Terjual:</h5>
                                    <canvas id="maxPenjualanChart"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <h5>Jenis Barang Terendah Terjual:</h5>
                                    <canvas id="minPenjualanChart"></canvas>
                                </div>
                            </div>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Chart.js Diagram -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <canvas id="penjualanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2 mb-5">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4 mt-3">
                        <div class="col-xl-6">
                            <h3>Report Transaksi</h3>
                        </div>
                        <div class="col-xl-6 text-right">
                            <button id="btn-tertinggi" class="btn btn-primary" onclick="sortTable(true)">Tertinggi</button>
                            <button id="btn-terendah" class="btn btn-secondary" onclick="sortTable(false)">Terendah</button>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <table class="table table-bordered border-primary">
                            <thead class="table-dark">
                                <tr>
                                    <th>Jenis Barang</th>
                                    <th>Jumlah yang dibeli</th>
                                </tr>
                            </thead>
                            <tbody id="penjualan-table-body">
                                @foreach ($penjualanPerJenisBarang as $item)
                                    <tr>
                                        <td>{{ $item->jenisbarang->nama_jenisbarang }}</td>
                                        <td>{{ $item->total_terjual }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script>
        const chartData = @json($chartData);
        const top5Data = chartData.slice(0, 5); // Top 5 chart data

        // Setup chart data for Penjualan
        const labels = chartData.map(item => item.nama_jenisbarang);
        const data = chartData.map(item => item.total_terjual);

        const ctx = document.getElementById('penjualanChart').getContext('2d');
        const penjualanChart = new Chart(ctx, {
            type: 'bar', // Bar chart type
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Terjual',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const maxPenjualanData = @json($maxPenjualan);
        const minPenjualanData = @json($minPenjualan);

        // Menyiapkan data untuk grafik Penjualan Barang Terbanyak
        const maxPenjualanChart = new Chart(document.getElementById('maxPenjualanChart'), {
            type: 'pie',
            data: {
                labels: [maxPenjualanData.jenisbarang.nama_jenisbarang], // Nama jenis barang
                datasets: [{
                    label: 'Penjualan Barang Terbanyak',
                    data: [maxPenjualanData.total_terjual], // Jumlah penjualan barang terbanyak
                    backgroundColor: ['#FF5733'], // Warna sektor grafik
                    borderColor: ['#C70039'], // Warna border sektor
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Menyiapkan data untuk grafik Penjualan Barang Terendah
        const minPenjualanChart = new Chart(document.getElementById('minPenjualanChart'), {
            type: 'pie',
            data: {
                labels: [minPenjualanData.jenisbarang.nama_jenisbarang], // Nama jenis barang
                datasets: [{
                    label: 'Penjualan Barang Terendah',
                    data: [minPenjualanData.total_terjual], // Jumlah penjualan barang terendah
                    backgroundColor: ['#FFC300'], // Warna sektor grafik
                    borderColor: ['#FF5733'], // Warna border sektor
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        // Menyiapkan data untuk grafik Penjualan per Jenis Barang (Chart untuk semua barang)
        const pieChartData = {
            labels: chartData.map(item => item.nama_jenisbarang), // Label untuk setiap jenis barang
            datasets: [{
                label: 'Penjualan per Jenis Barang',
                data: chartData.map(item => item.total_terjual), // Total penjualan untuk setiap barang
                backgroundColor: chartData.map((item, index) => `hsl(${(index * 40) % 360}, 70%, 50%)`), // Warna otomatis untuk setiap sektor
                borderColor: chartData.map((item, index) => `hsl(${(index * 40) % 360}, 80%, 40%)`), // Border warna otomatis
                borderWidth: 1
            }]
        };

        // Grafik Penjualan per Jenis Barang
        const allPenjualanChart = new Chart(document.getElementById('allPenjualanChart'), {
            type: 'pie',
            data: pieChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });

        let isHighest = true;  

        function sortTable(highest) {
            if (highest) {
                document.getElementById('btn-tertinggi').classList.remove('btn-secondary');
                document.getElementById('btn-tertinggi').classList.add('btn-primary');
                document.getElementById('btn-terendah').classList.remove('btn-primary');
                document.getElementById('btn-terendah').classList.add('btn-secondary');
            } else {
                document.getElementById('btn-terendah').classList.remove('btn-secondary');
                document.getElementById('btn-terendah').classList.add('btn-primary');
                document.getElementById('btn-tertinggi').classList.remove('btn-primary');
                document.getElementById('btn-tertinggi').classList.add('btn-secondary');
            }

            let rows = Array.from(document.getElementById('penjualan-table-body').getElementsByTagName('tr'));
            
            rows.sort(function(a, b) {
                let aValue = parseInt(a.cells[1].textContent);
                let bValue = parseInt(b.cells[1].textContent);
                return highest ? bValue - aValue : aValue - bValue;
            });


            let tableBody = document.getElementById('penjualan-table-body');
            rows.forEach(row => tableBody.appendChild(row));
        }
    </script>
@endpush
