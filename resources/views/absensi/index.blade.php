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
                        <h2 class="content-header-title float-start mb-0">Meal Attendance SKP</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Meal Attendance
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
                                <form method="GET" action="absensi/exportExcel">
                                    <h5 class="card-title"></h5>
                                    <div class="row g-1 mb-md-1">
                                        <div class="col-md-2">
                                            <button type="button" id="btn_tambah" class="mt-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal"><i data-feather='plus-circle'></i> Tambah Data</button>
                                            
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Tanggal Awal</label>
                                            <input id="tanggal_awal" name="tanggal_awal" class="form-control" id="colFormLabel"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Tanggal Akhir</label>
                                            <input id="tanggal_akhir" name="tanggal_akhir" class="form-control" id="colFormLabel"/>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="reset" id="btn_reset" class="mt-2 btn btn-danger"><i data-feather='delete'></i> Reset</button>
                                        </div>
                                    </div>
                                    {{-- <button type="button" id="filter" class="btn btn-primary mb-5">Filter</button> --}}
                                    {{-- <a href="/absensi/exportexcel/" class="btn btn-success mb-5"><i data-feather='file'></i> Export Excel</a>
                                    <a href="/absensi/exportpdf" class="btn btn-danger mb-5"><i data-feather='file-text'></i> Export PDF</a> --}}
                                    {{-- <button type="button" id="importkaryawan" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#importModal">Import Data absensi</button> --}}
                                    <table id="table-absensi" class="datatables-ajax table table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Tanggal Absensi (Admin)</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Ajax Sourced Server-side -->

            <!-- Modal Tambah absensi -->
            <div class="modal fade text-start" id="tambahModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formAbsensi" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <ul id="save_errorList"></ul>
                                <div class="row g-3">
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Nama Karyawan</label>
                                            <select class="select2 form-select" name="karyawan_id" id="optionKaryawan" required>
                                                <option selected disabled>Pilih Nama Karyawan</option>
                                                @foreach ($karyawan as $kr)
                                                    <option value="{{ $kr->id }}">{{ $kr->nama_depan }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="status form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Tanggal</label>
                                        <input id="tanggal_absensi_tambah" type="text" name="tanggal_absensi" class="tanggal_absensi form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block" data-backdrop="false" id="btn-simpan" value="create">Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Tambah Absensi --}}

            <!-- Modal Edit absensi -->
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
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Nama Karyawan</label>
                                            <select class="select2 form-select" name="karyawan_id" id="karyawan_id">
                                                <option selected disabled>Pilih Nama Karyawan</option>
                                                @foreach ($karyawan as $kr)
                                                    <option value="{{ $kr->id }}">{{ $kr->nama_depan }}</option>
                                                @endforeach
                                                <option value="auditor">Auditor</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" id="status" value="" class="status form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Tanggal Absensi (Admin)</label>
                                        <input type="text" name="tanggal_absensi" id="tanggal_absensi" value="" class="tanggal_absensi form-control">
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
            {{-- End Modal Tambah Absensi --}}

            <!-- Modal Konfirmasi Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PERHATIAN</h5>
                        </div>
                        <div class="modal-body">
                            <p><b>Jika menghapus absensi maka</b></p>
                            <p>*data absensi tersebut hilang selamanya, apakah anda yakin?</p>
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

<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/jszip.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Function datepicker
        $( function() {
            $( "#tanggal_awal" ).datepicker({
                "dateFormat": "dd-mm-yy"
            });
            $( "#tanggal_akhir" ).datepicker({
                "dateFormat": "dd-mm-yy"
            });
            $( "#tanggal_absensi_tambah" ).datepicker({
                "dateFormat": "dd-mm-yy"
            });
        });

        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        function fetch(tanggal_awal, tanggal_akhir) {
            var table = $('#table-absensi').DataTable({
                dom          : '<"card-body border-bottom p-0 pb-1"<"dt-action-buttons text-start"B>><"d-flex justify-content-start float-left mx-0 row"<"col-sm-3 col-md-6"l><"col-sm-3 col-md-6"f>>t<"d-flex justify-content-start mx-0 row"<"col-sm-3 col-md-6"i><"col-sm-3 col-md-6"p>>',
                displayLength: 7, // Show entries
                lengthMenu   : [7, 10, 25, 50, 75, 100], // Show entries option
                buttons      : [
                    {
                        extend   : 'copy',
                        text     : feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    },
                    {
                        extend   : 'print',
                        text     : feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                    },
                    {
                        extend   : 'csv',
                        text     : feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    },
                    {
                        extend   : 'excel',
                        text     : feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    },
                    {
                        extend   : 'pdf',
                        text     : feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    },
                ],
                processing: true,
                serverSide: true,        //Aktifkan server-side
                ajax: {
                    url     : "/absensi",
                    type    : 'GET',
                    data    : {
                        tanggal_awal : tanggal_awal,
                        tanggal_akhir: tanggal_akhir
                    },
                },
                columns: [{
                        data: 'karyawan',
                        name: 'karyawan'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'tanggal_absensi',
                        name: 'tanggal_absensi'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
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
        }
        fetch();

        // Function untuk mengubah datatable berdasarkan tanggal yang dipilih
        $("#tanggal_akhir").on("change", function(e) {
            e.preventDefault();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();
            if (tanggal_awal == "" || tanggal_akhir == "") {
                alert("Both date required");
            } else {
                $('#table-absensi').DataTable().destroy();
                fetch(tanggal_awal, tanggal_akhir);
            }
        });

        // Reset
        $("#btn_reset").on("click", function(e) {
            e.preventDefault();
            $("#tanggal_awal").val(''); // empty value
            $("#tanggal_akhir").val('');
            $('#table-absensi').DataTable().destroy();
            fetch();
        });

    });

    // Function untuk tombol tambah absensi dan tampilkan modal
    $(document).ready(function() {
        // $.noConflict();
        $('#btn_tambah').click(function() {
            // console.log($('#btn_tambah'));
            $('#btn-simpan').val("tambah-absensi");
            // $('#karyawan_id').val('');
            $('#tambahModal').modal('show');
            $('#formAbsensi').trigger("reset");
            $('#modal-judul').html("Tambah Absensi");
            $('#optionKaryawan').select2({
                dropdownParent: $('#tambahModal')
            });
        });

    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika id = formAbsensi panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#formAbsensi").length > 0) {
        $("#formAbsensi").validate({
            submitHandler: function(form) {
                var actionType = $('#btn-simpan').val();
                // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                var formData = new FormData($('#formAbsensi')[0]);
                $.ajax({
                    data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                    url: "/absensi/store", //url simpan data
                    type: "POST", //data tipe kita kirim berupa JSON
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var oTable = $('#table-absensi').dataTable(); //inialisasi datatable
                        oTable.fnDraw(false); //reset datatable
                        if (response.status == 400) {
                            $('#save_errorList').html("");
                            $('#save_errorList').removeClass('d-none');
                            $.each(response.errors, function(key, err_value) {
                                $('#save_errorList').append('<li>' + err_value +
                                    '</li>');
                            });

                            $('#btn-simpan').text('Menyimpan..');
                        
                        // console.log(response.status);
                        } else if (response.status == 409) {
                            $('#formAbsensi').find('input').val('');
                            toastr.error(response.errors);
                            $('#tambahModal').trigger('click');

                        } else if (response.status == 200) {
                            $('#modalJudul').html("");
                            $('#formAbsensi').find('input').val('');
                            toastr.success(response.message + response.timestamp);
                            $('#tambahModal').trigger('click');
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

    // Function Edit Absensi
    $(document).on('click', '.edit-absensi', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $('#editModal').modal('show');
        $('#titleEdit').html("Edit Data Absensi");
        $('#karyawan_id').select2({
            dropdownParent: $('#editModal')
        });

        $.ajax({
            type: "GET",
            url: "/absensi/edit/" + id,
            success: function(response) {
                // console.log(response);
                // Jika sukses maka munculkan notifikasi
                if (response.status == 404) {
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('#editModal').modal('hide');
                } else {
                    $('#id').val(id);
                    $('#karyawan_id').val(response.karyawan_id).trigger('change');
                    $('#status').val(response.status);
                    $('#tanggal_absensi').val(response.tanggal_absensi);
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
        $('.btn-close').find('input').val('');

    });

    // Function Update Data Absensi
    $(document).on('submit', '#formEdit', function(e) {
        e.preventDefault();
        var id = $('#id').val();

        // Mengubah data menjadi objek agar file image bisa diinput kedalam database
        var EditFormData = new FormData($('#formEdit')[0]);

        $.ajax({
            type: "POST",
            url: "/absensi/update/" + id,
            data: EditFormData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
                var oTable = $('#table-absensi').dataTable(); //inialisasi datatable
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
            url: "/absensi/delete/" + id, //eksekusi ajax ke url ini
            type: 'delete',
            beforeSend: function() {
                $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
            },
            success: function(response) { //jika sukses
                setTimeout(function() {
                    $('#modalHapus').modal('hide');
                    var oTable = $('#table-absensi').dataTable();
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
</script>
@endsection