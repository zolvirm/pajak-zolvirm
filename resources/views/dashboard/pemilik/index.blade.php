@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>SEMUA PEMILIK</h4>
    </div>

    {{-- untuk alert --}}
    @if (session()->has('berhasil'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
                {{ session('berhasil') }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- alert eror --}}
    @if (isset($errors) && $errors->any())
        <div class="d-flex justify-content-center"></div>
        <div class="alert alert-danger alert-dismissible col-lg-8" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
        </div>
    @endif

    {{-- untuk alert error Failures --}}
    @if (session()->has('failures'))
        <div class="d-flex justify-content-center ">
            <div class="alert alert-danger alert-dismissible col-lg-8 p-2 pb-0" role="alert">
                <table class="table table-danger">
                    <tr class="text-center">
                        <th>Row</th>
                        <th>Atribut</th>
                        <th>Errors</th>
                        <th>Value</th>
                    </tr>
                    @foreach (session()->get('failures') as $validation)
                        <tr>
                            <td class="p-0 m-0">{{ $validation->row() }}</td>
                            <td class="p-0 m-0">{{ $validation->attribute() }}</td>
                            <td class="p-0 m-0">
                                <ul class="p-0 m-0">
                                    @foreach ($validation->errors() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-0 m-0">
                                {{ $validation->values()[$validation->attribute()] }}
                            </td>
                        </tr>
                    @endforeach
                </table>
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- tombol diatas dan fitur search --}}
    <div class="row">
        <div class="col-lg-8 mb-3">
            <a href="/dash/pemiliks/create" class="btn btn-success btn-sm">Tambah Data Pemilik</a>
            <a href="/pemilik-export" class="btn btn-success btn-sm">Export</a>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                data-bs-target="#pemilikImportModal" data-bs-whatever="@mdo">Import</button>
        </div>
        <div class="col-lg-4">
            <form action="pemiliks">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control shadow-none" placeholder="search" aria-label="search"
                        value="{{ request('search') }}" id="search" name="search" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="submit" id="button-addon2">Cari</button>
                </div>
            </form>
        </div>
    </div>

    {{-- <a href="/pajak-import" class="btn btn-success mb-3">Import Data Pajak <span data-feather="plus-circle"></span></a> --}}

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="table" class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><a href="#" class="text-decoration-none text-dark"><span data-feather="filter" class="text-danger"></span> Nama</a> </th>
                            <th>Dusun</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Alamat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($pemiliks->count())
                            @foreach ($pemiliks as $index => $p)
                                <tr>
                                    <td class="text-center">{{ $index + $pemiliks->firstItem() }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td class="text-center">{{ $p->dusun }}</td>
                                    <td class="text-center">{{ $p->RT }}</td>
                                    <td class="text-center">{{ $p->RW }}</td>
                                    <td class="text-start">{{ $p->alamat }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">

                                            <a href="/dash/pemiliks/{{ $p->id }}" class="badge text-bg-light border"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><span
                                                    data-feather="eye" class="text-primary"></span></a>
                                            <a href="/dash/pemiliks/{{ $p->id }}/edit"
                                                class="badge text-bg-light border" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><span data-feather="edit"
                                                    class="text-warning"></span></a>
                                            <form action="/dash/pemiliks/{{ $p->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="badge text-bg-light border" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus"
                                                    onclick="return confirm('APAKAH YAKIN INGIN MENGHAPUS?')">
                                                    <span data-feather="x-octagon" class="text-danger"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="py-2 text-center"><strong>data kosong</strong></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="d-flex justify-content-start">
        {{ $pemiliks->onEachSide(1)->links() }}
    </div> --}}

    {{-- MODAL UPLOAD EXCEL --}}
    <div class="modal fade" id="pemilikImportModal" tabindex="-1" aria-labelledby="importPemilikLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="importPemilikLabel">Form Upload Excel</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/pemilik-import" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="excel" class="form-label">Data Excel</label>
                            <input required autofocus id="excel" name="excel"
                                class="form-control @error('excel') is-invalid @enderror" type="file">

                            @error('excel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="/contoh-excel-pemilik" class="btn btn-link"><small>DOWNLOAD CONTOH</small></a>
                            <button type="submit" class="btn btn-success">Import Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{ $pemiliks->links() }}
@endsection
