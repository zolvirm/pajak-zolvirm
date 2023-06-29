@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
        <h6 class="h2">Data Pajak <span class="badge bg-secondary">{{ $pajak->nama }}</span></h6>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">NOP</label>
        <div class="col-sm-10">
            <p>: {{ $pajak->NOP }}</p>
        </div>

        <label class="col-sm-2 col-form-label">Nama NPWP</label>
        <div class="col-sm-10">
            <p>: {{ $pajak->nama }}</p>
        </div>

        <label class="col-sm-2 col-form-label">Tahun</label>
        <div class="col-sm-10">
            <p>: {{ $pajak->tahun }}</p>
        </div>

        <label class="col-sm-2 col-form-label">Yang Harus Di Bayar</label>
        <div class="col-sm-10">
            <p>: @rupiah($pajak->yang_harus_dibayar)</p>
        </div>

        <label class="col-sm-2 col-form-label">Pemilik</label>
        <div class="col-sm-10">
            @if ($pajak->pemilik->id == 0)
                <p class="text-warning">: <strong>{{ $pajak->pemilik->nama }}</strong></p>
            @else
                <p>: {{ $pajak->pemilik->nama }}</p>
            @endif
        </div>

        <label class="col-sm-2 col-form-label">Status Pembayaran</label>
        <div class="col-sm-10">
            <p>:
                @if ($pajak->status_id == 0)
                    <span class="badge bg-secondary">belum lunas</span>
                @else
                    <span class="badge bg-success">lunas</span>
                @endif
            </p>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            <a href="/dash/pajaks" class="badge bg-primary text-decoration-none "><span data-feather="arrow-left"></span>
                &nbsp; kembali</a>
        </label>
    </div>
@endsection
