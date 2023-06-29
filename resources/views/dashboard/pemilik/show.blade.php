@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
        <h6 class="h2">Data <span class="text-primary">{{ $pemilik->nama }}</span></h6>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">Nama Pemilik</label>
        <div class="col-sm-10">
            <p>: {{ $pemilik->nama }}</p>
        </div>

        <label class="col-sm-2 col-form-label">Dusun</label>
        <div class="col-sm-10">
            <p>: {{ $pemilik->dusun }}</p>
        </div>

        <label class="col-sm-2 col-form-label">RT / RW</label>
        <div class="col-sm-10">
            <p>: {{ $pemilik->RT }} / {{ $pemilik->RW }}</p>
        </div>

        <label class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
            <p>: {{ $pemilik->alamat }}</p>
        </div>
        <label class="col-sm-2 col-form-label">Pajak Yang di Tanggung</label>
        @if ($pajaks->count())
            <div class="col-sm-12">
                <table class="table table-bordered border-success">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">NOP</th>
                            <th scope="col">Nama NPWP</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pajaks as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->NOP }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">
                                    @if ($item->status_id == '1')
                                        <p class="badge bg-success mb-0">Lunas</p>
                                    @else
                                        <p class="badge bg-danger mb-0">Belum Lunas</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @else
            <div class="col-sm-5">
                : <span class="badge bg-warning">Belum punya pajak</span>
            </div>
        @endif
    </div>
    <div class="mb-3 row">
        <label class="col-sm-2 col-form-label">
            <a href="/dash/pemiliks" class="btn btn-sm btn-success text-decoration-none "><span data-feather="arrow-left-circle"></span>
                &nbsp; kembali</a>
        </label>
    </div>
@endsection
