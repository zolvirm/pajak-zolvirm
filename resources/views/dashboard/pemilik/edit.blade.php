@extends('dashboard.layout.main')

@push('styles')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="{{ asset('js/ajax.googleapis-jquery-3.5.1.min.js') }}"></script>
    {{-- select2 cdn --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('container')
    <div class="row">
        <div class="col-lg-8">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-5 border-bottom">
                <h1 class="h2">EDIT DATA PEMILIK</h1>
            </div>

            <form method="post" action="/dash/pemiliks/{{ $pemilik->id }}">
                @method('put')
                @csrf

                <div class="mb-3 row">
                    <div class="col-lg-8">
                        <label for="nama" class="form-label">Nama</label>
                        <input required type="text" class="form-control @error('nama') is-invalid @enderror"
                            id="nama" name="nama" placeholder="cth: Jhony"
                            value="{{ old('nama', $pemilik->nama) }}">

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
                            id="dusun" name="dusun" placeholder="cth: Tanon"
                            value="{{ old('dusun', $pemilik->dusun) }}">

                        @error('dusun')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <label for="RT" class="form-label">RT</label>
                        <input required type="number" class="form-control @error('RT') is-invalid @enderror" id="RT"
                            name="RT" placeholder="cth 1" value="{{ old('RT', $pemilik->RT) }}">

                        @error('RT')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-lg-2">
                        <label for="RW" class="form-label">RW</label>
                        <input required type="number" class="form-control @error('RW') is-invalid @enderror" id="RW"
                            name="RW" placeholder="cth 1" value="{{ old('RW', $pemilik->RW) }}">

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
                            id="alamat" name="alamat" placeholder="cth: Jhony"
                            value="{{ old('alamat', $pemilik->alamat) }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="mb-3 row">
                    <div class="col-lg-8">
                        <select class="form-select select_pajak mb-3" id="" name="pajak[]" multiple="multiple">
                            @foreach ($pajaks as $item)
                                @if (old('pajak[]') == [$item->id] || $item->pemilik_id == $pemilik->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->NOP }} /
                                        {{ $item->nama }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->NOP }} / {{ $item->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-3 mt-3 mb-5">
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
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
