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
        dateFormat: "d M Y"
    };

    if (userRole !== "owner") {
        flatpickrOptions.minDate = "today"; // Non-owners tidak bisa pilih tanggal sebelumnya
    }

    $("#datePicker").flatpickr(flatpickrOptions);
    $("#deadline").flatpickr(flatpickrOptions);
});

$(document).ready(function() {
    // Mengambil semua elemen dengan kelas .deadline-text
    $('.deadline-text').each(function() {
        // Ambil status overdue dari atribut data
        var isOverdue = $(this).data('overdue');
        var taskTitle = $(this).closest('.task-row').find('.title').text(); // Misalnya, ambil judul task
        
        if (isOverdue) {
            // Tampilkan peringatan jika tugas sudah lewat deadline
            $(this).text('Warning: your task "' + taskTitle + '" has reached its deadline');
            $(this).css('color', 'red'); // Tambahkan styling agar peringatan lebih terlihat
        } else {
            // Jika belum melewati deadline, tampilkan tanggal deadline biasa
            var deadline = $(this).data('deadline'); 
            $(this).text('Deadline: ' + deadline);
        }
    });
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
                        columns: [0, 1, 2, 3, 4, 5],
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
                        columns: [0, 1, 2, 3, 4, 5],
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
                        columns: [0, 1, 2, 3, 4, 5],
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
                        columns: [0, 1, 2, 3, 4, 5],
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
                        columns: [0, 1, 2, 3, 4, 5],
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
        $('#modal-judul').html("Add New Task");
        $('#selectPrioTB').select2({
            dropdownParent: $('#tambahModal')
        });
        $('#priority').select2({
            dropdownParent: $('#editModal')
        });
        $('#selectStatusTB').select2({
            dropdownParent: $('#tambahModal')
        });
        $('#task_status').select2({
            dropdownParent: $('#editModal')
        });
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

// Function Edit task
$(document).on('click', '.edit-task', function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $('#editModal').modal('show');
    $('#titleEdit').html("Edit Task");
    $('#success_message').empty().removeClass('alert alert-success alert-danger');

    $.ajax({
        type: "GET",
        url: "/task/edit/" + id,
        success: function(response) {
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-danger');
                $('#success_message').text(response.message);
                $('#editModal').modal('hide');
            } else {
                $('#id').val(id);
                $('#title').val(response.title);
                $('#description').val(response.description);
                
                // Tampilkan deadline dalam format "D M Y"
                let formattedDate = moment(response.deadline).format('D MMM YYYY'); // Misalnya, "15 Oct 2024"
                $('#datePicker').val(formattedDate);
                
                $('#priority').val(response.priority);
                $('#task_status').val(response.task_status);
                $('#note').val(response.note);
            }
        },
        error: function(response) {
            console.log(response);
            $('#success_message').addClass('alert alert-danger');
            $('#success_message').text("Error! Something went wrong while fetching the task data.");
        }
    });

    $('.btn-close').click(function() {
        $('#editForm')[0].reset();
    });
});


// Function Update Data task
$(document).on('submit', '#formEdit', function(e) {
    e.preventDefault();
    var id = $('#id').val();

    // Mengubah data menjadi objek agar file image bisa diinput kedalam database
    var EditFormData = new FormData($('#formEdit')[0]);

    $.ajax({
        type: "POST",
        url: "/task/update/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            var oTable = $('#table-task').dataTable(); //inialisasi datatable
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
                toastr.success(response.message);
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
        url: "/task/delete/" + id, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
            $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
        },
        success: function(response) { //jika sukses
            setTimeout(function() {
                $('#modalHapus').modal('hide');
                var oTable = $('#table-task').dataTable();
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