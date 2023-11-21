@extends('master.template')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Guess Satisfaction Lumire Hotel</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Guess Satisfaction
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Ajax Sourced Server-side -->
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal"><i data-feather='plus-circle'></i> Tambah Data</button>
                                <a href="/karyawan/exportexcelkaryawan" class="btn btn-success mb-5"><i data-feather='file'></i> Export Excel</a>
                                <a href="/karyawan/exportpdf" class="btn btn-danger mb-5"><i data-feather='file-text'></i> Export PDF</a>
                                <table id="table-karyawan" class="datatables-ajax table table-responsive display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>E-mail</th>
                                            <th>Experience Score</th>
                                            <th>Description</th>
                                            <th>Suggestion</th>
                                            <th>Recommend</th>
                                            <th>Arrival</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Ajax Sourced Server-side -->

            <!-- Modal Tambah karyawan -->
            <div class="modal fade text-start" id="tambahModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formKaryawan" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="user_id" id="user_id">
                                <ul id="save_errorList"></ul>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Depan</label>
                                        <input type="text" name="nama_depan" class="nama_depan form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Belakang</label>
                                        <input type="text" name="nama_belakang" class="nama_belakang form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="tempat_lahir form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="text" name="tanggal_lahir" class="tanggal_lahir form-control" required>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="select2 form-select" name="jenis_kelamin" id="selectJK" required>
                                                <option>Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="email form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Avatar</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Tambah Karyawan --}}

            <!-- Modal Edit karyawan -->
            <div class="modal fade text-start" id="editModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="titleEdit"></h4>
                            <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEdit" name="formEdit" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <ul id="save_errorList"></ul>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Depan</label>
                                        <input type="text" id="nama_depan" name="nama_depan" class="nama_depan form-control" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Belakang</label>
                                        <input type="text" id="nama_belakang" name="nama_belakang" class="nama_belakang form-control" value="">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="tempat_lahir form-control" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="tanggal_lahir form-control" value="" required>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="select2 form-select" name="jenis_kelamin" id="jenis_kelamin">
                                                <option disabled>Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Avatar</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block" id="btn-update" value="create">Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Tambah Karyawan --}}

            <!-- Modal Konfirmasi Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PERHATIAN</h5>
                        </div>
                        <div class="modal-body">
                            <p><b>Jika menghapus karyawan maka</b></p>
                            <p>*data karyawan tersebut hilang selamanya, apakah anda yakin?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="btn-hapus" data-target="#btn-hapus" class="btn btn-danger tambah_data" value="add">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Modal Konfirmasi Delete --}}
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section ('script')
<script src="{{ asset('Template/app-assets/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
{{-- <script>
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
        $('#table-karyawan').DataTable({
            processing: true,
            serverSide: true,   //aktifkan server-side 
            ajax: {
                url: "/karyawan",
                type: 'GET'
            },
            columns: [{
                    data: 'nama_depan',
                    name: 'nama_depan'
                },
                {
                    data: 'nama_belakang',
                    name: 'nama_belakang'
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir'
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
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
                    $('#jenis_kelamin').val(response.jenis_kelamin).trigger('change');
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
</script> --}}
@endsection