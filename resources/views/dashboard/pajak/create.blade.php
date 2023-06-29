@extends('dashboard.layout.main')

@section('container')
    <div class="row">
        <div class="col-lg-8">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
                <h1 class="h2">TAMBAH DATA PAJAK</h1>
            </div>

            <form action="/dash/pajaks" method="post">
                @csrf

                <div class="mb-3 row">
                    <div class="col-lg-4">
                        <label for="NOP" class="form-label">NOP</label>
                        <input required autofocus type="text" class="form-control @error('NOP') is-invalid @enderror"
                            id="NOP" name="NOP" placeholder="cth: 12345" value="{{ old('NOP') }}">

                        @error('NOP')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-8">
                        <label for="nama" class="form-label">Nama NPWP</label>
                        <input required type="text" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" name="nama" placeholder="cth: Jhony" value="{{ old('nama') }}">

                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="mb-3 row">
                    <div class="col-lg-4">
                        <label for="yang_harus_dibayar" class="form-label">Yang Harus Dibayar</label>
                        <input required type="text"
                            class="form-control @error('yang_harus_dibayar') is-invalid @enderror" id="rupiah"
                            name="yang_harus_dibayar" placeholder="cth: 1000" value="{{ old('yang_harus_dibayar') }}">

                        @error('yang_harus_dibayar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input required type="text" class="form-control @error('tahun') is-invalid @enderror"
                            id="tahun" name="tahun" placeholder="cth: 2020" value="{{ old('tahun') }}">

                        @error('tahun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        </div>
        <div class="mb-3 row">
            <div class="col-lg-4">

                <label for="pemilik_id" class="form-label">Pemilik</label>
                <select class="form-select" name="pemilik_id" required>
                    <option value="0">Pelih Pemilik Pajak</option>
                    @foreach ($pemiliks as $pem)
                        @if (old('pemilik_id') == $pem->id)
                            {{-- kalau === berarti harus sama nilai dan tipe datanya, kalau == cuman harus sama nilainya saja --}}
                            <option value="{{ $pem->id }}">{{ $pem->nama }}</option>
                        @else
                            <option value="{{ $pem->id }}">{{ $pem->nama }}</option>
                        @endif
                    @endforeach

                </select>
            </div>
            <div class="col-lg-6">

            </div>
        </div>
        <div class="col-sm-3 mt-3 mb-5">
            <button type="submit" class="btn btn-primary">Buat Data Pajak Baru</button>
        </div>

        </form>


    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/rupiah.js') }}"></script>
@endpush
