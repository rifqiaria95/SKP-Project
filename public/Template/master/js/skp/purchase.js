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


// Panggil fungsi secara inisial dan ikatnya ke event perubahan
$(document).ready(function () {
    calculateTotalAndGrandTotal();

    $('.harga, harga2, .quantity, .quantity2').on('change', calculateTotalAndGrandTotal);
    $('#repeater, #itemContainer').on('change', '.harga, .quantity', calculateTotalAndGrandTotal);
});

// DatePicker
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
                    <select name="item[]" class="select2 form-select getItem2" required>
                        <option selected disabled>Pilih Item</option>
                        ` + options + `
                    </select>
                </div>
                <div class="col-md-3 col-12 mb-md-0 mb-3">
                    <label class="form-label" for="multicol-phone">Harga</label>
                    <input
                    type="text"
                    id="getHarga2"
                    class="form-control harga getHarga2"
                    placeholder="Harga item"
                    aria-label=""
                    readonly="readonly"
                    />
                </div>
                <div class="col-md-2 col-12 mb-md-0 mb-3">
                    <label class="form-label" for="multicol-phone">Quantity</label>
                    <input
                    type="number"
                    name="quantity[]"
                    class="form-control quantity"
                    placeholder="1"
                    aria-label="Masukkan quantity"
                    />
                </div>
                <div class="col-md-3 col-12">
                    <label class="form-label" for="multicol-phone">Total</label>
                    <input
                    type="text"
                    name="total_harga[]"
                    class="form-control total_harga"
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

// Hanya ikat event untuk #addItem
$("#addItem").on("click", function () {
    var target = "#repeater";
    addItemHandler(target);
});

function addItem4Handler(target) {
    var options = '';
    $.each(items, function(index, item) {
        options += '<option value="' + item.id + '">' + item.nama_item + '</option>';
    });

    // Create new element and hide it
    var newElement = $(`
        <div class="repeater4 d-flex border rounded position-relative pe-0 mt-3" style="display: none;">
            <div id="rowHarga" class="row w-100 p-3">
                <div class="col-md-4">
                    <label class="form-label" for="multicol-first-name">Nama Item</label>
                    <select name="item[]" class="select2 form-select getItem4" required>
                        <option selected disabled>Pilih Item</option>
                        ` + options + `
                    </select>
                </div>
                <div class="col-md-3 col-12 mb-md-0 mb-3">
                    <label class="form-label" for="multicol-phone">Harga</label>
                    <input
                    type="text"
                    id="getHarga2"
                    class="form-control harga"
                    placeholder="Harga item"
                    aria-label=""
                    readonly="readonly"
                    />
                </div>
                <div class="col-md-2 col-12 mb-md-0 mb-3">
                    <label class="form-label" for="multicol-phone">Quantity</label>
                    <input
                    type="number"
                    name="quantity[]"
                    class="form-control quantity"
                    placeholder="1"
                    aria-label="Masukkan quantity"
                    />
                </div>
                <div class="col-md-3 col-12">
                    <label class="form-label" for="multicol-phone">Total</label>
                    <input
                    type="text"
                    name="total_harga[]"
                    class="form-control total_harga"
                    placeholder="Total Harga"
                    aria-label="Total Harga"
                    readonly="readonly"
                    />
                </div>
            </div>
            <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                <i id="delete-item" class="ti ti-x cursor-pointer delete-item" data-repeater-delete></i>
            </div>
        </div>`
    );

    // Append the new element, slide it down, and then show it
    $(target).append(newElement);
    newElement.slideDown();
}

// Bind click event to addItem2
$("#addItem4").on("click", function () {
    var target = "#itemContainer";
    addItem4Handler(target);
    // calculateTotalAndGrandTotal(); // Menghitung total harga dan grand total setelah menambahkan item baru
});

// Function to handle click event on delete icon
$(document).on("click", ".ti-x", function () {
    // Simpan referensi ke elemen repeater2 yang dihapus untuk penggunaan berikutnya
    var deletedElement = $(this).closest('.repeater2');
    
    // Cari elemen repeater2 terdekat dari elemen yang diklik, lalu animasikan slide up, dan kemudian hapusnya dari DOM
    deletedElement.slideUp(400, function () {
        $(this).remove();
        // Setelah item dihapus, panggil fungsi untuk menghitung ulang total harga dan grand total
        calculateTotalAndGrandTotal();
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

// Function to add new item
function addItem() {
    var newItemIndex = $('.repeater-wrapper').length;
    var itemHtml = getItemHtml({}); // Jika item baru, berikan objek kosong untuk membuat placeholder data
    $('#itemContainer').append(itemHtml);
    
    // Reinitialize select2 for newly added item
    $('#getItem3_' + newItemIndex).select2({
        dropdownParent: $('#editModal')
    });

    // Reinitialize event listeners for new item's quantity field
    $('#quantity_' + newItemIndex).on('change', calculateTotalAndGrandTotal);

    // Reinitialize event listener for delete item button
    $('.delete-item').off().on('click', function() {
        $(this).closest('.repeater-wrapper').remove();
        calculateTotalAndGrandTotal();
    });
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
                $('#status').val(response.status);
                $('#vendor_id').val(response.vendor_id).trigger('change');
                $('#perusahaan_id').val(response.perusahaan_id).trigger('change');
                $('#pic_1').val(response.pic_1).trigger('change');
                $('#pic_2').val(response.pic_2).trigger('change');
                $('.grand_total2').val(response.grand_total).trigger('change');
                $('.grand_total2').text(response.grand_total).trigger('change');
                $('.sub_total4').val(response.sub_total).trigger('change');
                $('.sub_total4').text(response.sub_total).trigger('change');

                // Clear existing item containers
                $('#itemContainer').empty();

                if (response.item.length > 0) {
                    // Loop through each item and append new item containers
                    response.item.forEach(function(item, index) {
                        var itemHtml = getItemHtml(item, index);
                        $('#itemContainer').append(itemHtml);
            
                        // Reinitialize select2 for each item
                        $('#getItem3_' + index).select2({
                            dropdownParent: $('#editModal')
                        });
            
                        // Reinitialize event listeners for each item's quantity field
                        $('#quantity_' + index).on('change', function() {
                            // Call calculateTotalAndGrandTotal to recalculate total prices
                            calculateTotalAndGrandTotal();
                        });
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
            <div id="itemContainer${index + 1}" class="mb-3" data-repeater-list="group-a">
                <div class="repeater3 repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                    <div class="d-flex border rounded position-relative pe-0">
                        <div id="row${index + 1}" class="row w-100 p-3">
                            <div class="col-md-4">
                                <label class="form-label" for="multicol-first-name">Nama Item</label>
                                <select name="item[]" id="getItem3_${index}" class="select2 form-select" required>
                                    <option selected disabled>Pilih Item</option>
                                    <option value="${item.id}" selected>${item.nama_item}</option>
                                </select>
                            </div>                                
                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                <label class="form-label" for="multicol-phone">Harga</label>
                                <input type="text" id="getHarga2_${index}" class="form-control harga2" value="${item.harga}" placeholder="Harga item" aria-label="Masukkan quantity" readonly="readonly" />
                            </div>
                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                <label class="form-label" for="multicol-phone">Quantity</label>
                                <input type="number" id="quantity_${index}" name="quantity[]" class="form-control quantity2" placeholder="1" value="${item.pivot.quantity}" aria-label="Masukkan quantity" />
                            </div>
                            <div class="col-md-3 col-12">
                                <label class="form-label" for="multicol-phone">Total</label>
                                <input type="text" id="total_harga_${index}" name="total_harga[]" class="form-control total_harga2" value="${item.pivot.total_harga}" placeholder="Total Harga" aria-label="Total Harga" readonly="readonly" />
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                            <i class="ti ti-x cursor-pointer delete-item"></i>
                        </div>                                
                    </div>
                </div>
            </div>
        `;
    }
    
});

function calculateTotalAndGrandTotal() {
    var grandTotal     = 0;
    var totalHargaAll  = 0;
    var totalHargaAll2 = 0;
    var totalHargaAll4 = 0;  // Initialize totalHargaAll4
    var ppn            = 0;  // Initialize grandTotal2
    var grandTotal2    = 0;  // Initialize grandTotalAll

    // Calculation for the initial set of elements
    var harga             = parseFloat($('.harga').val().replace(/[^\d.-]/g, '').replace(',', '.')) || 0;  // Mengambil nilai harga dan mengonversinya ke float
    var quantity          = parseFloat($('.quantity').val()) || 0;                                         // Mengambil nilai quantity dan mengonversinya ke float
    var subTotal          = (harga * quantity);
    var totalTax          = (subTotal * 0.11);
    var grandTotalInitial = (parseFloat(subTotal) + parseFloat(totalTax));

    // Format angka ke format Indonesia
    var formatter = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 3            // Menjaga tiga angka di belakang koma
    });

    $('.total_harga').val(formatter.format(subTotal).replace(',', '.')); // Mengatur nilai total harga dengan format Indonesia
    $('.grand_total').val(formatter.format(grandTotalInitial).replace(',', '.')); // Mengatur nilai grand total dengan format Indonesia

    // Update grand total including both grandTotal and grandTotal2
    grandTotal    += parseFloat(grandTotalInitial);
    totalHargaAll += parseFloat(subTotal);

    // Calculation for dynamically added elements
    $('.repeater2').each(function () {
        var harga             = parseFloat($(this).find('.harga').val().replace(/[^\d.-]/g, '').replace(',', '.')) || 0;
        var quantity          = parseFloat($(this).find('.quantity').val()) || 0;
        var subTotal          = harga * quantity;
        var totalTax          = subTotal * 0.11;
        var grandTotalDynamic = subTotal + totalTax;

        // Format angka ke format Indonesia
        var formattedSubTotal          = formatter.format(subTotal).replace(',', '.');
        var formattedGrandTotalDynamic = formatter.format(grandTotalDynamic).replace(',', '.');

        // Mengatur nilai total harga dengan format Indonesia, atau 0 jika harga atau quantity kosong
        $(this).find('.total_harga').val(isNaN(subTotal) ? 0 : formattedSubTotal); 

        // Mengatur nilai grand total dengan format Indonesia
        $(this).find('.grand_total').val(formattedGrandTotalDynamic);

        // Update grand total including both grandTotal and grandTotal2
        grandTotal    += grandTotalDynamic;
        totalHargaAll += subTotal;
    });

    // Calculation for the initial set of elements
    $('.repeater3, .repeater4').each(function () {
        var harga               = parseFloat($(this).find('.harga, .harga2').val().replace(/[^\d.-]/g, '').replace(',', '.')) || 0;
        var quantity            = parseFloat($(this).find('.quantity, .quantity2').val()) || 0;
        var subTotal            = quantity * harga;
        var formattedTotalHarga = formatter.format(subTotal).replace(',', '.');

        // Mengatur nilai total harga dengan format Indonesia, atau 0 jika harga atau quantity kosong
        $(this).find('.total_harga, .total_harga2').val(isNaN(subTotal) ? 0 : formattedTotalHarga);

        if ($(this).hasClass('repeater2')) {
            totalHargaAll2 += subTotal;
        } else {
            totalHargaAll4 += subTotal;
        }
        
        grandTotal += subTotal;
    });


    // Calculate totalHargaAll4 by summing totalHargaAll and totalHargaAll2
    totalHargaAll4 += totalHargaAll2;

    // Calculate grandTotal2
    ppn = totalHargaAll4 * 0.11;

    grandTotal2 = totalHargaAll4 + ppn;

    // Update totalHargaAll4 field
    $('.sub_total4').val(formatter.format(totalHargaAll4).replace(',', '.')).text(formatter.format(totalHargaAll4).replace(',', '.'));

    // Update grandTotal2 field
    $('.grand_total2').val(formatter.format(grandTotal2).replace(',', '.')).text(formatter.format(grandTotal2).replace(',', '.'));

    // Update totalHargaAll and grandTotal for the entire form
    $('.sub_total').text(formatter.format(totalHargaAll).replace(',', '.'));
    $('.sub_total2').text(formatter.format(totalHargaAll2).replace(',', '.'));
    $('.grand_total').val(formatter.format(grandTotal).replace(',', '.')).text(formatter.format(grandTotal).replace(',', '.'));

}


// Function update data purchase order
$(document).on('submit', '#formEdit', function(e) {
    e.preventDefault();

    // Mengumpulkan data dari formulir
    var formData = new FormData($(this)[0]);

    // Mengambil ID dari input hidden dengan ID "id"
    var id = $('#id').val();

    if (!id) {
        console.error("ID not found or null");
        return;
    }

    // Mengambil data dari #addItem2 (jika diperlukan)
    var items = $('.repeater4');
    items.each(function(index, element) {
        var item        = $(element).find('.getItem4').val();
        var quantity    = $(element).find('.quantity').val();
        var total_harga = $(element).find('.total_harga').val();

        formData.append('item[' + index + ']', item);
        formData.append('quantity[' + index + ']', quantity);
        formData.append('total_harga[' + index + ']', total_harga);
    });

    $.ajax({
        type: "POST",
        url: "/purchaseorder/update/" + id,
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            var oTable = $('#table-purchase').dataTable();
            oTable.fnDraw(false);
            if (response.status == 400) {
                $('#modalJudulEdit').html("");
                $('#modalJudulEdit').removeClass('d-none');
                $.each(response.errors, function(key, err_value) {
                    $('#modalJudulEdit').append('<li>' + err_value + '</li>');
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

// Function delete item saat update data
$(document).on('click', '.delete-item', function() {

    var idpurchase = $('#id').val();
    var iditem     = $(this).closest('.repeater-wrapper').find('select[name="item[]"]').val();
    var itemContainer = $(this).closest('.mb-3'); // Select the item container to be deleted

    $.ajax({
        type: "POST",
        url: "/purchaseorder/" + idpurchase + "/" + iditem + "/deleteitem",
        data: {
            "idpurchase": idpurchase,
            "iditem": iditem // Mengirim token CSRF dengan nama _token
        },
        success: function(response) {
            // handle success response, maybe refresh the item list or do something else
            console.log("Item deleted successfully");
            // Slide up and then remove the item container from the DOM upon successful deletion
            itemContainer.slideUp(400, function() {
                $(this).remove();
                calculateTotalAndGrandTotal();
            });
        },
        error: function(response) {
            // handle error response
            console.error("Error deleting item");
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


// Function to handle change event on getItem2 select element
$(document).on("change", ".getItem2", function () {
    // Mendapatkan nilai yang dipilih dari elemen select
    var itemId = $(this).val();
    
    // Anda kemudian dapat menggunakan itemId untuk mencari harga terkait dari sumber data Anda
    // Misalnya, jika Anda memiliki daftar item di dalam items array dan setiap item memiliki harga tersimpan di dalamnya
    var selectedPrice = items.find(item => item.id == itemId).harga;
    
    // Setel nilai harga ke dalam input harga yang sesuai
    $(this).closest('.repeater2').find('.getHarga2').val(selectedPrice);
});

// Function to handle click event on getItem4
$(document).on("change", ".getItem4", function () {
    // Mendapatkan nilai yang dipilih dari elemen select
    var itemId = $(this).val();
    
    // Anda kemudian dapat menggunakan itemId untuk mencari harga terkait dari sumber data Anda
    // Misalnya, jika Anda memiliki daftar item di dalam items array dan setiap item memiliki harga tersimpan di dalamnya
    var selectedPrice = items.find(item => item.id == itemId).harga;
    
    // Setel nilai harga ke dalam input harga yang sesuai
    $(this).closest('.repeater4').find('.harga').val(selectedPrice);
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