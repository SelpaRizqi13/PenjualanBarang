<div class="header pb-8 pt-5 pt-md-8" style="background: linear-gradient(135deg,rgba(252,185,0,1) 0%,rgba(255,105,0,1) 100%)">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Kategori Barang</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $jenisbarang }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Master Barang</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $barang }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Penjualan</h5>
                                    <span class="h2 font-weight-bold mb-0">{{ $penjualan }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>