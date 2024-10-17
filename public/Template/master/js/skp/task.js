$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function() {

    // Mengatur konfigurasi Flatpickr berdasarkan userRole
    var flatpickrOptions = {
        dateFormat: "D M Y"
    };

    if (userRole !== "owner") {
        flatpickrOptions.minDate = "today"; // Non-owners tidak bisa pilih tanggal sebelumnya
    }

    $("#datePicker").flatpickr(flatpickrOptions);
    $("#deadline").flatpickr(flatpickrOptions);
});


//MULAI DATATABLE
//script untuk memanggil data json dari server dan menampilkannya berupa datatable
$(document).ready(function() {
    // $.noConflict();
    var tableOptions = {
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
                extend: 'collection',
                className: 'btn btn-label-secondary dropdown-toggle mx-3',
                text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="ti ti-printer me-2" ></i>Print',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be print
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        },
                        customize: function (win) {
                        //customize print view for dark
                        $(win.document.body)
                            .css('color', headingColor)
                            .css('border-color', borderColor)
                            .css('background-color', bodyBg);
                        $(win.document.body)
                            .find('table')
                            .addClass('compact')
                            .css('color', 'inherit')
                            .css('border-color', 'inherit')
                            .css('background-color', 'inherit');
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="ti ti-file-text me-2" ></i>Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="ti ti-copy me-2" ></i>Copy',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    }
                ]
            },
            {
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add Task</span>',
                className: 'btn_tambah add-new btn btn-primary mx-3',
                attr: {
                    'data-bs-toggle': 'tambahModal',
                    'data-bs-target': '#tambahModal'
                }
            }
        ],
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "/task",
            type: 'GET'
        },
        columns: [{
                data: 'title',
                name: 'title'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'deadline',
                name: 'deadline'
            },
            {
                data: 'priority',
                name: 'priority'
            },
            {
                data: 'task_status',
                name: 'task_status'
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
    };

    $('#table-task').DataTable(tableOptions);
});

// DatePicker
(function () {
    const invoiceDateList = document.querySelectorAll('.date-picker');
  
    // Datepicker
    if (invoiceDateList) {
      invoiceDateList.forEach(function (invoiceDateEl) {
        invoiceDateEl.flatpickr({
          monthSelectorType: 'static',
          dateFormat: 'd-m-Y',
        });
      });
    }
})();

// Function untuk tombol tambah task dan tampilkan modal
$(document).ready(function() {
    // $.noConflict();
    $('.btn_tambah').click(function() {
        // console.log($('#btn_tambah'));
        $('#btn-simpan').val("tambah-task");
        $('#tambahModal').modal('show');
        $('#formItem').trigger("reset");
        $('#modal-judul').html("Tambah task");
    });
});

//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
//jika id = formItem panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
if ($("#formItem").length > 0) {
    $("#formItem").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-simpan').val();
            // Mengubah data menjadi objek agar file image bisa diinput kedalam database
            var formData = new FormData($('#formItem')[0]);
            $.ajax({
                data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                url: "/task/store", //url simpan data
                type: "POST", //data tipe kita kirim berupa JSON
                contentType: false,
                processData: false,
                success: function(response) {
                    var oTable = $('#table-task').dataTable(); //inialisasi datatable
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
                        $('#modalJudul').html("");
                        $('#formItem').find('input').val('');
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