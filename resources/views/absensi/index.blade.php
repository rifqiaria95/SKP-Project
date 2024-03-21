@extends('master.template')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Meal Attendance /</span> SKP</h4>
            <!-- DataTable with Buttons -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-2">
                        <button type="button" id="btn_tambah" class="btn btn-primary" data-bs-toggle="modal-tambah" data-bs-target="#tambahModal"><i class="menu-icon tf-icons ti ti-plus"></i> Tambah Data</button>
                    </div>
                    <div class="col-md-2">
                        <input id="tanggal_awal" name="tanggal_awal" class="form-control" placeholder="Tanggal Awal" id="colFormLabel"/>
                    </div>
                    <div class="col-md-2">
                        <input id="tanggal_akhir" name="tanggal_akhir" class="form-control" placeholder="Tanggal Akhir" id="colFormLabel"/>
                    </div>
                    <div class="col-md-2">
                        <button type="reset" id="btn_reset" class="btn btn-danger"><i class="menu-icon tf-icons ti ti-eraser"></i> Reset</button>
                    </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table id="table-absensi" class="datatables-ajax table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Jabatan</th>
                            <th>Tanggal Absensi (Admin)</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
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
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="select2 form-select" name="status" id="optionKaryawan" required>
                                                <option selected disabled>Pilih Status</option>
                                                <option value="Karyawan">Karyawan</option>
                                                <option value="Non Karyawan">Non Karyawan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Jabatan</label>
                                            <select class="select2 form-select" name="job_title" id="optionKaryawan" required>
                                                <option selected disabled>Pilih Jabatan</option>
                                                @foreach ($karyawan as $kr)
                                                    <option value="{{ $kr->job_title }}">{{ $kr->job_title }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
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
                                                <option value="Non Karyawan">Non Karyawan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="select2 form-select" name="status" id="status">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="Karyawan">Karyawan</option>
                                                <option value="Non Karyawan">Non Karyawan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Jabatan</label>
                                            <select class="select2 form-select" name="job_title" id="job_title">
                                                <option selected disabled>Pilih Jabatan</option>
                                                @foreach ($karyawan as $kr)
                                                    <option value="{{ $kr->job_title }}">{{ $kr->job_title }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
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
      <!-- / Content -->
    <!-- Content wrapper -->
@endsection
@section ('script')
    <!-- Vendors JS -->
    <!-- Flat Picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('Template/master/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/js/jszip.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/master/vendor/js/pdfmake.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/master/vendor/js/vfs_fonts.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/master/vendor/js/buttons.html5.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/master/vendor/js/buttons.print.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>

    <!-- Page JS -->
    <script src="{{ asset('Template/master/js/tables-datatables-basic.js') }}"></script>
    <script src="{{ asset('Template/master/js/skp/absensi.js') }}"></script>
@endsection