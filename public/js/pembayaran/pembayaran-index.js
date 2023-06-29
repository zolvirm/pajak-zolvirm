// $("#package").on("change", function () {
//     // ambil data dari elemen option yang dipilih
//     const price = $("#package option:selected").data("price");
//     const discount = $("#package option:selected").data("discount");

//     // kalkulasi total harga
//     const totalDiscount = (price * discount) / 100;
//     const total = price - totalDiscount;

//     // tampilkan data ke element
//     $("[name=price]").val(price);
//     $("[name=discount]").val(totalDiscount);

//     $("#total").text(`Rp ${total}`);
// });

$(document).ready(function () {
    // pajak();
    // function pajak() {
    //     $.ajax({
    //         type: "GET",
    //         url: "/pembayaran-jq",
    //         dataType: "json",
    //         success: function (response) {
    //             $.each(response.pajaks, function (key, item) {
    //                 $("#pil_pajak").append(
    //                     '<option value="' + item.id + '">' + item.NOP + " - " + item.nama + "</option>" );
    //             });
    // $.each(response.pajaks, function (key, item) {
    //     $("tbody").append(
    //         '<tr>\
    //         <th scope="row">' +
    //             item.id +
    //             "</th>\
    //         <td>" +
    //             item.NOP +
    //             "</td>\
    //         <td>" +
    //             item.nama +
    //             "</td>\
    //         <td>" +
    //             item.yang_harus_dibayar +
    //             "</td>\
    //     </tr>"
    //     );
    // });
    //         },
    //     });
    // }
});
