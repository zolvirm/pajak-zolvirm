$(document).ready(function () {
    $("#tabel_pajak").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        ajax: {
            url: $("#url_ajax").val(), //di ambil dari id inputan hidden yang berada di index pajaks
        },
        columns: [
            // DT_RowIndex akan terhubung dengan controllerpajak class seting_table bagian addIndexColumn
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "NOP", name: "NOP" },
            { data: "nama", name: "nama" },
            { data: "yang_harus_dibayar", name: "yang_harus_dibayar" },
            { data: "status_id", name: "status_id" },
            // { data: "opsi", name: "opsi", orderable: false, searchable: false },
        ],
    });
});

// $(document).ready(function () {
//     $("#tabel_pajak").DataTable();
// });
