@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Trash Pemilik</h1>
    </div>

    @if (session()->has('berhasil'))
        <div class="d-flex justify-content-center">
            <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
                {{ session('berhasil') }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-9">
            <div class="table-responsive">
                <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">nama</th>
                            <th scope="col">alamat</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($trashs2->count())
                            @foreach ($trashs2 as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + $trashs2->firstItem() }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <div class="d-inline">
                                                <a href="/dash/restore-pemilik/{{ $item->id }}"
                                                    class="badge text-bg-light border text-decoration-none"
                                                    onclick="return confirm('DATA AKAN DI KEMBALIKAN?')">
                                                    <small class="text-white badge bg-dark">KEMBALIKAN &nbsp;<span
                                                            data-feather="arrow-left" class="text-white"></span></small>
                                                </a>
                                            </div>
                                            &nbsp;
                                            <form action="/dash/forcedelete-pemilik/{{ $item->id }}" method="post"
                                                class="d-inline">
                                                @csrf
                                                <button class="badge text-bg-light border" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Hapus"
                                                    onclick="return confirm('Are you sure?')">
                                                    <span data-feather="x-octagon" class="text-danger"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="py-2 text-center"><strong>data kosong</strong></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-start">
        {{ $trashs2->onEachSide(1)->links() }}
    </div>
@endsection
