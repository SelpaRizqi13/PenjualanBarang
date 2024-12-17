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
                        <h1>Janji Temu</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow p-4">
                    <div class="card-header border-0">
                        <form method="POST" action="{{ route('janjitemu.store') }}">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-xl-8">
                                    <div class="row mb-3">
                                        <label for="" class="col-xl-4">Judul</label>
                                        <input type="text" name="judul" class="col-md-8 form-control">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-xl-4">Peserta</label>
                                        <select name="creator_id" id="creator_id" data-control="select2" class="form-control form-select-solid col-xl-8">
                                            <option value="">--Pilih Peserta--</option>
                                            @foreach ($user as $users)
                                                <option value="{{ $users->id }}" data-zone="{{ $users->timezone }}">{{ $users->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-xl-4">Waktu Mulai</label>
                                        <input type="datetime-local" id="waktu_awal" name="waktu_awal" class="col-md-8 form-control">
                                    </div>
                                    <div class="row mb-3">
                                        <label for="" class="col-xl-4">Waktu Selesai</label>
                                        <input type="datetime-local" id="waktu_akhir" name="waktu_akhir" class="col-md-8 form-control">
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row mt-5 align-items-right" style="text-align: right">
                                <button type="submit" class="btn btn-primary col-xl-2">Simpan</button>
                                <button class="btn btn-secondary col-xl-2" href="{{ url('janjitemu') }}">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/luxon@3.3.0/build/global/luxon.min.js"></script>
    <script>
       $(document).ready(function() {
    $('#creator_id').select2({
        theme: 'bootstrap-5'
    });
});

document.getElementById('creator_id').addEventListener('change', function () {
    validateTime();
});

document.getElementById('waktu_awal').addEventListener('change', function () {
    validateTime();
});

document.getElementById('waktu_akhir').addEventListener('change', function () {
    validateTime();
});

function validateTime() {
    const waktuMulai = document.getElementById('waktu_awal').value;
    const waktuSelesai = document.getElementById('waktu_akhir').value;
    const creatorId = document.getElementById('creator_id').value;

    if (!creatorId || !waktuMulai || !waktuSelesai) {
        return; // Pastikan semua input valid, jika tidak berhenti.
    }
    
    const selectedOption = document.querySelector(`#creator_id option[value='${creatorId}']`);
    const timezone = selectedOption.getAttribute('data-zone'); // Ambil zona waktu dari opsi peserta

    const startTime = new Date(waktuMulai);
    const endTime = new Date(waktuSelesai);

    // Konversi waktu ke zona waktu peserta menggunakan library seperti 'luxon' atau 'moment-timezone'
    const startTimeInCreatorTimezone = convertToTimezone(startTime, timezone);
    const endTimeInCreatorTimezone = convertToTimezone(endTime, timezone);

    // Tentukan jam kerja berdasarkan zona waktu creator
    const workStartHour = 8;  // Mulai jam 08:00 (AM)
    const workEndHour = 16;   // Selesai jam 16:00 (4 PM) untuk waktu mulai
    const workEndHourFinal = 17; // Selesai jam 17:00 (5 PM) untuk waktu selesai

    // Validasi Waktu Mulai
    if (startTimeInCreatorTimezone.getHours() < workStartHour || startTimeInCreatorTimezone.getHours() >= workEndHourFinal) {
        alert('Waktu Mulai harus antara jam 08:00 AM hingga 05:00 PM sesuai dengan zona waktu peserta.');
        return;
    }

    // Validasi Waktu Selesai
    if (endTimeInCreatorTimezone.getHours() <= startTimeInCreatorTimezone.getHours() || endTimeInCreatorTimezone.getHours() >= workEndHourFinal || (endTimeInCreatorTimezone.getHours() === workEndHourFinal && endTimeInCreatorTimezone.getMinutes() > 0)) {
        alert('Waktu Selesai jangan kurang dari waktu mulai dan harus antara jam 08:00 AM hingga 05:00 PM sesuai dengan zona waktu peserta.');
        return;
    }
}

function convertToTimezone(date, timezone) {
    // Menggunakan library Luxon untuk mengonversi waktu
    // Pastikan Anda sudah mengimpor Luxon di layout utama atau file javascript Anda
    const { DateTime } = luxon;
    return DateTime.fromJSDate(date).setZone(timezone).toJSDate();
}
    </script>
@endpush