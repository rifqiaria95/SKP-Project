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
    $('#table-vendor').DataTable({
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "/vendor",
            type: 'GET'
        },
        columns: [
            {
                data: 'nama_vendor',
                name: 'nama_vendor'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'no_tlp',
                name: 'no_tlp'
            },
            {
                data: 'pic',
                name: 'pic'
            },
            {
                data: 'jabatan_pic',
                name: 'jabatan_pic'
            },
            {
                data: 'note',
                name: 'note'
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

document.getElementById("formVendor").addEventListener("submit", function(event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the value of the note textarea
    var noteValue = document.querySelector('.editor').value;

    // Remove <ol> and <li> tags
    noteValue = noteValue.replace(/<ol>|<\/ol>|<li>|<\/li>/g, '');

    // Set the updated value back to the textarea
    document.querySelector('.editor').value = noteValue;

    // Now submit the form
    this.submit();
});


// Function untuk tombol tambah vendor dan tampilkan modal
$(document).ready(function() {
    // $.noConflict();
    $('#btn_tambah').click(function() {
        // console.log($('#btn_tambah'));
        $('#btn-simpan').val("tambah-vendor");
        $('#tambahModal').modal('show');
        $('#formVendor').trigger("reset");
        $('#modal-judul').html("Tambah Vendor");
    });
});

//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
//jika id = formVendor panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
if ($("#formVendor").length > 0) {
    $("#formVendor").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-simpan').val();
            // Mengubah data menjadi objek agar file image bisa diinput kedalam database
            var formData = new FormData($('#formVendor')[0]);
            $.ajax({
                data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                url: "/vendor/store", //url simpan data
                type: "POST", //data tipe kita kirim berupa JSON
                contentType: false,
                processData: false,
                success: function(response) {
                    var oTable = $('#table-vendor').dataTable(); //inialisasi datatable
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
                        $('#formVendor').find('input').val('');
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

// Function Edit Vendor
$(document).on('click', '.edit-vendor', function(e) {
    e.preventDefault();

    var id = $(this).data('id');

    $('#editModal').modal('show');
    $('#titleEdit').html("Edit Data Vendor");

    $.ajax({
        type: "GET",
        url: "/vendor/edit/" + id,
        success: function(response) {
            console.log(response);
            // Jika sukses maka munculkan notifikasi
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
                $('#editModal').modal('hide');
            } else {
                $('#id').val(id);
                $('#nama_vendor').val(response.nama_vendor);
                $('#alamat').val(response.alamat);
                $('#no_tlp').val(response.no_tlp);
                $('#pic').val(response.pic);
                $('#jabatan_pic').val(response.jabatan_pic);
                $('#note').val(response.note);
            }
        },
        error: function(response) {
            console.log(response);
        }
    });
    $('.btn-close').find('input').val('');

});

// Function Update Data Vendor
$(document).on('submit', '#formEdit', function(e) {
    e.preventDefault();
    var id = $('#id').val();

    // Mengubah data menjadi objek agar file image bisa diinput kedalam database
    var EditFormData = new FormData($('#formEdit')[0]);

    $.ajax({
        type: "POST",
        url: "/vendor/update/" + id,
        data: EditFormData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log(response);
            var oTable = $('#table-vendor').dataTable(); //inialisasi datatable
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
        url: "/vendor/delete/" + id, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
            $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
        },
        success: function(response) { //jika sukses
            setTimeout(function() {
                $('#modalHapus').modal('hide');
                var oTable = $('#table-vendor').dataTable();
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