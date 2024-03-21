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
    // $.noConflict();
    $('#table-perusahaan').DataTable({
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
            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tambah Perusahaan</span>',
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
            url: "/perusahaan",
            type: 'GET'
        },
        columns: [{
                data: 'nama_perusahaan',
                name: 'nama_perusahaan'
            },
            {
                data: 'alamat_perusahaan',
                name: 'alamat_perusahaan'
            },
            {
                data: 'no_tlp_perusahaan',
                name: 'no_tlp_perusahaan'
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


// Function untuk tombol tambah perusahaan dan tampilkan modal
$(document).ready(function() {
    // $.noConflict();
    $('.btn_tambah').click(function() {
        // console.log($('#btn_tambah'));
        $('#btn-simpan').val("tambah-perusahaan");
        $('#perusahaan_id').val('');
        $('#tambahModal').modal('show');
        $('#formPerusahaan').trigger("reset");
        $('#modal-judul').html("Tambah Perusahaan");
        $('#selectJK').select2({
            dropdownParent: $('#tambahModal')
        });
        $('#selectPerusahaan').select2({
            dropdownParent: $('#tambahModal')
        });
    });
});

//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
//jika id = formPerusahaan panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
if ($("#formPerusahaan").length > 0) {
    $("#formPerusahaan").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-simpan').val();
            // Mengubah data menjadi objek agar file image bisa diinput kedalam database
            var formData = new FormData($('#formPerusahaan')[0]);
            $.ajax({
                data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                url: "/perusahaan/store", //url simpan data
                type: "POST", //data tipe kita kirim berupa JSON
                contentType: false,
                processData: false,
                success: function(response) {
                    var oTable = $('#table-perusahaan').dataTable(); //inialisasi datatable
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
                        $('#formPerusahaan').find('input').val('');
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

// Function Edit Perusahaan
$(document).on('click', '.edit-perusahaan', function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $('#editModal').modal('show');
    $('#titleEdit').html("Edit Data Perusahaan");
    $('#jenis_kelamin').select2({
        dropdownParent: $('#editModal')
    });
    $('#perusahaan_id').select2({
        dropdownParent: $('#editModal')
    });

    $.ajax({
        type: "GET",
        url: "/perusahaan/edit/" + id,
        success: function(response) {
            // console.log(response);
            // Jika sukses maka munculkan notifikasi
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
                $('#editModal').modal('hide');
            } else {
                $('#id').val(id);
                $('#nama_perusahaan').val(response.nama_perusahaan);
                $('#alamat_perusahaan').val(response.alamat_perusahaan);
                $('#no_tlp_perusahaan').val(response.no_tlp_perusahaan);
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
    $('.btn-close').find('input').val('');

});

// Function Update Data Perusahaan
$(document).on('submit', '#formEdit', function(e) {
    e.preventDefault();
    var id = $('#id').val();

    // Mengubah data menjadi objek agar file image bisa diinput kedalam database
    var EditFormData = new FormData($('#formEdit')[0]);

    $.ajax({
        type: "POST",
        url: "/perusahaan/update/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            var oTable = $('#table-perusahaan').dataTable(); //inialisasi datatable
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
        url: "/perusahaan/delete/" + id, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
            $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
        },
        success: function(response) { //jika sukses
            setTimeout(function() {
                $('#modalHapus').modal('hide');
                var oTable = $('#table-perusahaan').dataTable();
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