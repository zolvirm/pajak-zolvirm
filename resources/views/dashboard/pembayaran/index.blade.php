@extends('dashboard.layout.main')
@push('styles')
@endpush
@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>PEMBAYARAN</h4>
    </div>

    <form action="/dash/pemby">
        <select name="pemiliks" id="pemiliks">
            @foreach ($kadal as $item)
                @if (request('pemiliks') == $item->id)
                    <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                @endif
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
        <button type="submit"> oke boskuh</button>
    </form>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a> --}}



            <div class="row">
                <div class="col-md-4">
                    <form action="#">
                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example" name="pel_pajak"
                            id="pil_pajak">

                        </select>
                    </form>
                    <button type="button" class="btn btn-sm btn-success mt-4" data-bs-toggle="modal"
                        data-bs-target="#pemilik">PILIH PEMILIK</button>
                    <br>
                    <button type="button" class="btn btn-sm btn-success mt-3" data-bs-toggle="modal"
                        data-bs-target="#pajak_tambah">TAMBAH PAJAK OPSIONAL</button>
                    <br>
                    {{-- <form>
                        <select name="package" id="package">
                            <option data-price="100000" data-discount="10">Paket 1</option>
                            <option data-price="150000" data-discount="10">Paket 2</option>
                            <option data-price="200000" data-discount="10">Paket 3</option>
                        </select>

                        <div>
                            <label for="price">Harga</label>
                            <input type="text" name="price" readonly />
                            <br>
                            <label for="price">Discount</label>
                            <input type="text" name="discount" readonly />
                            <br>
                            <h4>Total: <span id="total">0</span></h4>
                        </div>
                    </form> --}}
                </div>
                <div class="col-md-8">
                    {{-- <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NOP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pajak</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table> --}}
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NOP</th>
                                <th>Nama NPWP</th>
                                <th>Pajak</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($megalodon as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $item->NOP }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>@rupiah($item->yang_harus_dibayar)</td>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td>
                                    <h5>@rupiah($total)</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="pemilik" tabindex="-1" aria-labelledby="pemilikLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pemilikLabel">Pilih Pemilik</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PAJAK --}}
    <div class="modal fade" id="pajak_tambah" tabindex="-1" aria-labelledby="pajak_tambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pajak_tambahLabel">Pilih Pajak</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="input_fields_wrap">
        <button class="add_field_button"> Tambah Pajak Lain</button>
    </div> --}}
@endsection
@push('scripts')
    <script src="{{ asset('js/pembayaran/pembayaran-index.js') }}"></script>
    <script>
        // $(document).ready(function() {
        //     var max_fields = 10; //maximum input boxes allowed
        //     var wrapper = $(".input_fields_wrap"); //Fields wrapper
        //     var add_button = $(".add_field_button"); //Add button ID

        //     var x = 1; //initlal text box count
        //     $(add_button).click(function(e) { //on add input button click
        //         e.preventDefault();
        //         //if (x < max_fields) { //max input box allowed
        //         x++; //text box increment
        //         $(wrapper).append(
        //             '<div class="mt-2"><input type="text" name="pajaks[]"/> &nbsp;<button id="remove_field"> X</button></div>'
        //         ); //add input box
        //         //}
        //     });

        //     $(wrapper).on("click", "#remove_field", function(e) { //user click on remove text
        //         e.preventDefault();
        //         $(this).parent('div').remove();
        //         x--;
        //     })
        // });
    </script>
@endpush
{{--  --}}
