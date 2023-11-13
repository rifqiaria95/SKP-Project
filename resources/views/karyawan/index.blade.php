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
                            <h2 class="content-header-title float-start mb-0">Data Karyawan PT Santini Kelola Persada</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Karyawan SKP
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
                                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Data</button>
                                    <a href="/karyawan/exportexcel" class="btn btn-success mb-5">Export Excel</a>
                                    <a href="/karyawan/exportpdf" class="btn btn-danger mb-5">Export PDF</a>
                                    <button type="button" id="importkaryawan" class="btn btn-success mb-5" data-bs-toggle="modal" data-bs-target="#importModal">Import Data karyawan</button>
                                    <table id="table-karyawan" class="datatables-ajax table table-responsive" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Depan</th>
                                                <th>Nama Belakang</th>
                                                <th>Tempat Lahir</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Ajax Sourced Server-side -->
                <!-- Button trigger modal -->
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
                                                <select class="select2 form-select" name="jenis_kelamin" id="select2-basicJk" required>
                                                <option value="">Pilih Jenis Kelamin</option>
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
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section ('script')
    <script src="{{ asset('Template/app-assets/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('Template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script>
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

        $(document).ready(function () {
            // $.noConflict();
            $('#btn_tambah').click(function() {
                // console.log($('#btn_tambah'));
                $('#btn-simpan').val("tambah-karyawan");
                $('#karyawan_id').val('');
                $('#tambahModal').modal('show');
                $('#formKaryawan').trigger("reset");
                $('#modal-judul').html("Tambah Karyawan");
                $('#select2-basicJk').select2({
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
                            } 
                            else if(response.status == 200)
                            {
                                $('#modalJudul').html("");
                                $('#formKaryawan').find('input').val('');
                                toastr.success(response.message);

                                $('#tambahModal').modal('hide');

                            }
                        },
                        error: function (response) {
                            console.log('Error:', response);
                            $('#btn-simpan').html('Simpan');
                        }
                    });
                }
            })
        }
    </script>
@endsection