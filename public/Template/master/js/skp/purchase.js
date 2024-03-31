$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

//MULAI DATATABLE
//script untuk memanggil data json dari server dan menampilkannya berupa datatable
$(document).ready(function() {

    'use strict';

    // $.noConflict();
    $('#table-purchase').DataTable({
        dom:
            '<"row me-2"' +
            '<"col-md-2"<"me-3"l>>' +
            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
            '>t' +
            '<"row mx-2"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        language: {
            sLengthMenu: '_MENU_',
            search: '',
            searchPlaceholder: 'Search..'
        },
        buttons: [
        {
            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tambah PO</span>',
            className: 'btn_tambah add-new btn btn-primary mx-3',
            attr: {
                'data-bs-toggle': 'modal',
                'data-bs-target': '#tambahModal'
            },
            // action: function ( e, dt, button, config ) {
            //     window.location = '/purchaseorder/create';
            // }    
        }
        ],
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "/purchaseorder",
            type: 'GET'
        },
        columns: [{
                data: 'nomor_po',
                name: 'nomor_po'
            },
            {
                data: 'nama_po',
                name: 'nama_po'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'user',
                name: 'user'
            },
            {
                data: 'aksi',
                name: 'aksi'
            },
        ],
        order: [
            [0, 'asc']
        ],
        
    });
});

function calculateTotalAndGrandTotal() {
    var total = 0;
    var grandTotal = 0;
    var totalHargaAll = 0; // Initialize totalHargaAll

    var tax = 0.11;

    // Calculation for the initial set of elements
    var quantity = $('.quantity').val();
    var harga = $('.harga').val();

    if (!isNaN(parseFloat(harga)) && !isNaN(parseFloat(quantity))) {
        var subTotal = parseFloat(quantity) * parseFloat(harga);
        var totalTax = subTotal * tax;
        total = subTotal;
        grandTotal += total + totalTax; // Tambahkan nilai total_harga ke grandTotal
    }

    $('.total_harga').val(total.toFixed(3));
    $('.total_harga').text(total.toFixed(3)); // Update tampilan total_harga

    // Calculation for dynamically added elements
    $('.repeater2').each(function () {
        var quantity = $(this).find('.quantity2').val();
        var harga = $(this).find('.harga2').val();
        var totalHarga = 0;

        if (!isNaN(parseFloat(harga)) && !isNaN(parseFloat(quantity))) {
            totalHarga = parseFloat(quantity) * parseFloat(harga);
            var subTotal = totalHarga;
            var totalTax = subTotal * tax;
            totalHarga = subTotal;
            grandTotal += totalHarga + totalTax;
            totalHargaAll += totalHarga; // Tambahkan nilai total_harga2 ke total_harga_all
        }

        $(this).find('.total_harga2').val(totalHarga.toFixed(3));
        $(this).find('.total_harga2').text(totalHarga.toFixed(3)); // Update tampilan total_harga2
    });

    // Update grand total including both grandTotal and grandTotal2
    $('.grand_total').val(grandTotal.toFixed(3));
    $('.grand_total').text(grandTotal.toFixed(3));

    // Update total harga all
    $('.total_harga_all').val(totalHargaAll.toFixed(3));
    $('.total_harga_all').text(totalHargaAll.toFixed(3));
}

// Call the function initially and bind it to the change event
$(document).ready(function () {
    calculateTotalAndGrandTotal();

    $('.harga, .quantity').on('change', calculateTotalAndGrandTotal);
    $('#repeater').on('change', '.harga2, .quantity2', calculateTotalAndGrandTotal);
    $('#repeaterEdit').on('change', '.harga2, .quantity2', calculateTotalAndGrandTotal); // Add this line for #repeaterEdit
});


(function () {
    const invoiceDateList = document.querySelectorAll('.date-picker');
  
    // Datepicker
    if (invoiceDateList) {
      invoiceDateList.forEach(function (invoiceDateEl) {
        invoiceDateEl.flatpickr({
          monthSelectorType: 'static'
        });
      });
    }
})();

// Tambah row item
function addItemHandler(target) {
    var options = '';
    $.each(items, function(index, item) {
        options += '<option value="' + item.id + '">' + item.nama_item + '</option>';
    });

    // Create new element and hide it
    var newElement = $(`
        <div class="repeater2 d-flex border rounded position-relative pe-0 mt-3" style="display: none;">
            <div id="rowHarga" class="row w-100 p-3">
                <div class="col-md-4">
                    <label class="form-label" for="multicol-first-name">Nama Item</label>
                    <select name="item[]" id="getItem2" class="select2 form-select" required>
                        <option selected disabled>Pilih Item</option>
                        ` + options + `
                    </select>
                </div>
                <div class="col-md-3 col-12 mb-md-0 mb-3">
                    <label class="form-label" for="multicol-phone">Harga</label>
                    <input
                    type="text"
                    id="getHarga2"
                    class="form-control harga2"
                    placeholder="Harga item"
                    aria-label=""
                    readonly="readonly"
                    />
                </div>
                <div class="col-md-2 col-12 mb-md-0 mb-3">
                    <label class="form-label" for="multicol-phone">Quantity</label>
                    <input
                    type="text"
                    name="quantity[]"
                    class="form-control quantity2"
                    placeholder="1"
                    aria-label="Masukkan quantity"
                    />
                </div>
                <div class="col-md-3 col-12">
                    <label class="form-label" for="multicol-phone">Total</label>
                    <input
                    type="text"
                    name="total_harga[]"
                    class="form-control total_harga2"
                    placeholder="Total Harga"
                    aria-label="Total Harga"
                    readonly="readonly"
                    />
                </div>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                <i class="ti ti-x cursor-pointer" data-repeater-delete></i>
            </div>
        </div>`
    );

    // Append the new element and slide it down
    $(target).append(newElement);
    newElement.slideDown();
}

$("#addItem, #addItem2").on("click", function () {
    var target = $(this).attr("id") === "addItem" ? "#repeater" : "#repeaterEdit";
    addItemHandler(target);
});


// Delete item
$(document).on("click", ".ti-x.cursor-pointer", function () {
    $(this).closest('.d-flex.border.rounded.position-relative.pe-0').slideUp(400, function(){
        $(this).remove();
    });
});

// Function untuk tombol tambah purchase dan tampilkan modal
$(document).ready(function() {
    // Function to initialize Select2 dropdowns
    function initializeSelect2() {
        $('.select2').select2({
            dropdownParent: $('#tambahModal')
        });
        // You may need to initialize other Select2 dropdowns if present
    }

    // Initialize Select2 dropdowns when modal is shown
    $('#tambahModal').on('shown.bs.modal', function() {
        initializeSelect2();
    });

    // Function to handle form submission
    function handleFormSubmission() {
        // Your form submission code here
    }

    // Validate and handle form submission when form is submitted
    if ($("#formPurchase").length > 0) {
        $("#formPurchase").validate({
            submitHandler: function(form) {
                handleFormSubmission();
            }
        });
    }
});


//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
//jika id = formPurchase panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
if ($("#formPurchase").length > 0) {
    $("#formPurchase").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-simpan').val();
            // Mengubah data menjadi objek agar file image bisa diinput kedalam database
            var formData = new FormData($('#formPurchase')[0]);
            $.ajax({
                data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                url: "/purchaseorder/store", //url simpan data
                type: "POST", //data tipe kita kirim berupa JSON
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var oTable = $('#table-purchase').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable
                    if (response.status == 400) {
                        $('#save_errorList').html("");
                        $('#save_errorList').removeClass('d-none');
                        $.each(response.errors, function(key, err_value) {
                            $('#save_errorList').append('<li>' + err_value +
                                '</li>');
                        });

                        $('#btn-simpan').text('Menyimpan..');
                    } else if (response.status == 200) {
                        // location.href = "/purchaseorder"
                        $('#modalJudul').html("");
                        $('#formPurchase')[0].reset();
                        toastr.success(response.message);
                        $('#tambahModal').modal('hide');

                    }
                },
                error: function(response) {
                    console.log('Error:', response);
                    $('#btn-simpan').html('Simpan');
                }
            });
        }
    })
}

// Function Edit Purchase
$(document).on('click', '#edit-purchase', function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $('#editModal').modal('show');
    $('#titleEdit').html("Edit Data Purchase");
    $('#perusahaan_id').select2({
        dropdownParent: $('#editModal')
    });
    $('#vendor_id').select2({
        dropdownParent: $('#editModal')
    });
    $('#item_id').select2({
        dropdownParent: $('#editModal')
    });

    $.ajax({
        type: "GET",
        url: "/purchaseorder/edit/" + id,
        success: function(response) {
            console.log(response);
            if (!jQuery.isEmptyObject(response)) {
                $('#id').val(id);
                $('#nomor_po').val(response.nomor_po);
                $('#nama_po').val(response.nama_po);
                $('#tanggal').val(response.tanggal);
                $('#ppn').val(response.ppn);
                $('#grand_total1').val(response.grand_total);
                $('#grand_total2').text(response.grand_total);
                $('#status').val(response.status);
                $('#vendor_id').val(response.vendor_id).trigger('change');
                $('#perusahaan_id').val(response.perusahaan_id).trigger('change');
                $('#pic_1').val(response.pic_1).trigger('change');
                $('#pic_2').val(response.pic_2).trigger('change');

                // Clear existing item containers
                $('#itemContainer').empty();

                if (response.item.length > 0) {
                    // Loop through each item and append new item containers
                    response.item.forEach(function(item, index) {
                        var itemHtml = getItemHtml(item, index);
                        $('#itemContainer').append(itemHtml);
                    });
                }
            } else {
                // Handle empty response
            }
        },
        error: function(response) {
            console.log(response);
            // Handle error, maybe show an error message
        }
    });
    
    // Function to generate HTML for an item
    function getItemHtml(item, index) {
        return `
            <div id="repeater${index + 1}" class="mb-3" data-repeater-list="group-a">
                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                    <div class="d-flex border rounded position-relative pe-0">
                        <div id="rowAja${index + 1}" class="row w-100 p-3">
                            <div class="col-md-4">
                                <label class="form-label" for="multicol-first-name">Nama Item</label>
                                <select name="item[]" id="getItem3_${index}" class="select2 form-select" required>
                                    <option selected disabled>Pilih Item</option>
                                    <option value="${item.id}" selected>${item.nama_item}</option>
                                </select>
                            </div>                                
                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                <label class="form-label" for="multicol-phone">Harga</label>
                                <input type="text" id="getHarga2_${index}" class="form-control harga" value="${item.harga}" placeholder="Harga item" aria-label="Masukkan quantity" readonly="readonly" />
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                <label class="form-label" for="multicol-phone">Quantity</label>
                                <input type="text" id="quantity_${index}" name="quantity[]" class="form-control" placeholder="1" value="${item.pivot.quantity}" aria-label="Masukkan quantity" />
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="multicol-phone">Total</label>
                                <input type="text" id="total_harga_${index}" name="total_harga[]" class="form-control" value="${item.pivot.total_harga}" placeholder="Total Harga" aria-label="Total Harga" readonly="readonly" />
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                            <i class="ti ti-x cursor-pointer delete-item" data-item-id="${item.id}"></i>
                        </div>                                
                    </div>
                </div>
            </div>
        `;
    }
});


// Function Update Data Purchase
$(document).on('submit', '#formEdit', function(e) {
    e.preventDefault();
    var id = $('#id').val();

    // Mengubah data menjadi objek agar file image bisa diinput kedalam database
    var EditFormData = new FormData($('#formEdit')[0]);

    $.ajax({
        type: "POST",
        url: "/purchaseorder/update/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function(response) {
            // console.log(response);
            var oTable = $('#table-purchase').dataTable(); //inialisasi datatable
            oTable.fnDraw(false); //reset datatable
            if (response.status == 400) {
                $('#modalJudulEdit').html("");
                $('#modalJudulEdit').removeClass('d-none');
                $.each(response.errors, function(key, err_value) {
                    $('#modalJudulEdit').append('<li>' + err_value +
                        '</li>');
                });

                $('#btn-update').text('Update');
            } else if (response.status == 404) {
                toastr.error(response.message);
            } else if (response.status == 200) {
                $('#modalJudulEdit').html("");
                toastr.success(response.message);

                $('#editModal').modal('hide');
            }
        },
        error: function(response) {
            console.log('Error:', response);
        }
    });

});

// Function Delete
//jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
$('body').on('click', '.delete', function() {
    id = $(this).attr('id');
    $('#modalHapus').modal('show');
});
//jika tombol hapus pada modal konfirmasi di klik maka
$('#btn-hapus').click(function(e) {
    e.preventDefault();
    $.ajax({
        url: "/purchaseorder/delete/" + id, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
            $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
        },
        success: function(response) { //jika sukses
            setTimeout(function() {
                $('#modalHapus').modal('hide');
                var oTable = $('#table-purchase').dataTable();
                oTable.fnDraw(false); //reset datatable
                if (response.status == 404) {
                    toastr.success(response.message);
                } else if (response.status == 200) {
                    toastr.success(response.message);
                }
            });
        },
        error: function(response) {
            console.log('Error:', response);
        }
    })
});

// Function get detail item
$(document).on('change', '#getItem1', function(e) {
    e.preventDefault();

    var id  = $(this).val();
    var url = "/purchaseorder/getDetailItem/" + id;

    $.ajax({
        type    : "GET",
        url     : url,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Jika sukses maka perbarui nilai input harga
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-danger');
                $('#success_message').text(response.message);
            } else {
                $('#id').val(id);
                $('#getHarga').val(response.harga); // Memperbarui nilai input harga
            }
        },
        error: function(jqXHR, exception) {
            console.error(jqXHR.responseText);
            alert("Terjadi kesalahan saat mengambil detail item.");
        }
    });

});


// Mengikatkan peristiwa perubahan pada elemen select dengan id getItem
$(document).on("change", "#getItem2", function() {
    // Mendapatkan nilai yang dipilih dari elemen select
    var itemId = $(this).val();
    
    // Anda kemudian dapat menggunakan itemId untuk mencari harga terkait dari sumber data Anda
    // Misalnya, jika Anda memiliki daftar item di dalam items array dan setiap item memiliki harga tersimpan di dalamnya
    var selectedPrice = items.find(item => item.id == itemId).harga;
    
    // Setel nilai harga ke dalam input harga yang sesuai
    $(this).closest('#rowHarga').find('#getHarga2').val(selectedPrice);
});

// Function get job title
$(document).on('change', '#nama_vendor', function(e) {
    e.preventDefault();

    var id  = $(this).val();
    var url =  "/purchaseorder/getDetail/" + id,
    url 	= url.replace(':id', id);

    $.ajax({
        type    : "GET",
        url     : url,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Jika sukses maka munculkan notifikasi
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
            } else {
                $('#id').val(id);
                $('#pic').val(response.pic).trigger('change');
                $('#jabatan_pic').val(response.jabatan_pic);
                $('#no_tlp').val(response.no_tlp);
                $('#alamat').val(response.alamat);
                $('#note').val(response.note);
            }
        },
        error: function(jqXHR, exception) {
            // console.log(response);
            alert(jqXHR.responseText);
        }
    });

});