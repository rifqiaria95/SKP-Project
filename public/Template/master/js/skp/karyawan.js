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
    
    $('#table-karyawan').DataTable({
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "/karyawan",
            type: 'GET'
        },
        columns: [
            {
                data: 'nama_depan',
                name: 'nama_depan'
            },
            {
                data: 'nama_belakang',
                name: 'nama_belakang'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'job_title',
                name: 'job_title'
            },
            {
                data: 'perusahaan',
                name: 'perusahaan'
            },
            {
                data: 'aksi',
                name: 'aksi'
            },
        ],
        order: [
            [0, 'asc']
        ]
    });
});

// Function untuk tombol tambah karyawan dan tampilkan modal
$(document).ready(function() {
    // $.noConflict();
    $('#btn_tambah').click(function() {
        // console.log($('#btn_tambah'));
        $('#btn-simpan').val("tambah-karyawan");
        $('#karyawan_id').val('');
        $('#tambahModal').modal('show');
        $('#formKaryawan').trigger("reset");
        $('#modal-judul').html("Tambah Karyawan");
        $('#selectJK').select2({
            dropdownParent: $('#tambahModal')
        });
        $('#selectPerusahaan').select2({
            dropdownParent: $('#tambahModal')
        });
    });
});

//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
//jika id = formKaryawan panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
if ($("#formKaryawan").length > 0) {
    $("#formKaryawan").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-simpan').val();
            // Mengubah data menjadi objek agar file image bisa diinput kedalam database
            var formData = new FormData($('#formKaryawan')[0]);
            $.ajax({
                data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                url: "/karyawan/store", //url simpan data
                type: "POST", //data tipe kita kirim berupa JSON
                contentType: false,
                processData: false,
                success: function(response) {
                    var oTable = $('#table-karyawan').dataTable(); //inialisasi datatable
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
                        $('#formKaryawan').find('input').val('');
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

// Function Edit Karyawan
$(document).on('click', '.edit-karyawan', function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $('#editModal').modal('show');
    $('#titleEdit').html("Edit Data Karyawan");
    $('#jenis_kelamin').select2({
        dropdownParent: $('#editModal')
    });
    $('#perusahaan_id').select2({
        dropdownParent: $('#editModal')
    });

    $.ajax({
        type: "GET",
        url: "/karyawan/edit/" + id,
        success: function(response) {
            // console.log(response);
            // Jika sukses maka munculkan notifikasi
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
                $('#editModal').modal('hide');
            } else {
                $('#id').val(id);
                $('#nama_depan').val(response.nama_depan);
                $('#nama_belakang').val(response.nama_belakang);
                $('#tempat_lahir').val(response.tempat_lahir);
                $('#tanggal_lahir').val(response.tanggal_lahir);
                $('#jenis_kelamin').val(response.jenis_kelamin);
                $('#status').val(response.status);
                $('#job_title').val(response.job_title);
                $('#perusahaan_id').val(response.perusahaan_id).trigger('change');
                $('#avatar').val();
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
    $('.btn-close').find('input').val('');

});

// Function Update Data Karyawan
$(document).on('submit', '#formEdit', function(e) {
    e.preventDefault();
    var id = $('#id').val();

    // Mengubah data menjadi objek agar file image bisa diinput kedalam database
    var EditFormData = new FormData($('#formEdit')[0]);

    $.ajax({
        type: "POST",
        url: "/karyawan/update/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            var oTable = $('#table-karyawan').dataTable(); //inialisasi datatable
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
        url: "/karyawan/delete/" + id, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
            $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
        },
        success: function(response) { //jika sukses
            setTimeout(function() {
                $('#modalHapus').modal('hide');
                var oTable = $('#table-karyawan').dataTable();
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