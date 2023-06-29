@extends('dashboard.layout.main')
@push('styles')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="{{ asset('js/ajax.googleapis-jquery-3.5.1.min.js') }}"></script>
    {{-- select2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/select2/custom-select2.css') }}">
@endpush
@section('container')
    <div class="row">
        <div class="col-lg-8">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
                <h1 class="h2">TAMBAH DATA PEMILIK</h1>
            </div>

            <form action="/dash/pemiliks" method="post">
                @csrf

                <div class="mb-3 row">
                    <div class="col-lg-8">
                        <label for="nama" class="form-label">Nama</label>
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
                        <label for="dusun" class="form-label">Dusun</label>
                        <input required type="text" class="form-control @error('dusun') is-invalid @enderror"
                            id="dusun" name="dusun" placeholder="cth: Tanon" value="{{ old('dusun') }}">

                        @error('dusun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <label for="RT" class="form-label">RT</label>
                        <input required type="number" class="form-control @error('RT') is-invalid @enderror" id="RT"
                            name="RT" placeholder="cth 1" value="{{ old('RT') }}">

                        @error('RT')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <label for="RW" class="form-label">RW</label>
                        <input required type="number" class="form-control @error('RW') is-invalid @enderror" id="RW"
                            name="RW" placeholder="cth 1" value="{{ old('RW') }}">

                        @error('RW')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-lg-8">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input required type="text" class="form-control @error('alamat') is-invalid @enderror"
                            id="alamat" name="alamat" placeholder="cth: Jhony" value="{{ old('alamat') }}">

                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-lg-8">
                        <label for="pajak" class="form-label">Pajak</label>
                        <select class="form-select select_pajak mb-3" id="pajak" name="pajak[]" multiple="multiple">
                            @foreach ($pajaks as $item)
                                @if (old('pajak[]') == [$item->id])
                                    <option data-namanama="{{ $item->nama }}" value="{{ $item->id }}"
                                        selected="selected">{{ $item->NOP }} /
                                        {{ $item->nama }}</option>
                                @else
                                <option data-namanama="{{ $item->nama }}" value="{{ $item->id }}">{{ $item->NOP }} /
                                    {{ $item->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-5 mt-3 mb-5">
                    <button type="submit" class="btn btn-primary">Buat Data Pemilik Baru</button>
                </div>

            </form>


        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".select_pajak").select2({
                placeholder: 'select',
                allowClear: true,
                closeOnSelect: false,
            });
        });
    </script>
@endpush
