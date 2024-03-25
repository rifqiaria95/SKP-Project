@extends('master.template')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Karyawan /</span>PT Santini Kelola Persada</h4>
            <!-- DataTable with Buttons -->
            <div class="card">
                <div class="card-body">
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="menu-icon tf-icons ti ti-plus"></i> Tambah Data</button>
                    <a href="/karyawan/exportexcelkaryawan" class="btn btn-success mb-5"><i class="menu-icon tf-icons ti ti-file-x"></i> Export Excel</a>
                    <a href="/karyawan/exportpdf" class="btn btn-danger mb-5"><i class="menu-icon tf-icons ti ti-file-text"></i> Export PDF</a>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="table-karyawan" class="datatables-ajax table">
                    <thead>
                        <tr>
                            <th>Nama Depan</th>
                            <th>Nama Belakang</th>
                            <th>Status</th>
                            <th>Jabatan</th>
                            <th>Perusahaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    </table>
                </div>
            </div>
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
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" id="status" readonly="readonly" value="Karyawan">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" name="job_title" class="job_title form-control" required>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Perusahaan</label>
                                            <select class="select2 form-select" name="perusahaan_id" id="selectPerusahaan" required>
                                                <option selected disabled>Pilih Perusahaan</option>
                                                @foreach ($perusahaan as $ph)
                                                    <option value="{{ $ph->id }}">{{ $ph->nama_perusahaan }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="email form-control" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
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
                                    <div class="col-md-6">
                                        <label class="form-label">Jabatan</label>
                                        <input type="text" id="job_title" name="job_title" class="job_title form-control" required>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Perusahaan</label>
                                            <select class="select2 form-select" name="perusahaan_id" id="perusahaan_id" required>
                                                <option selected disabled>Pilih Perusahaan</option>
                                                @foreach ($perusahaan as $ph)
                                                    <option value="{{ $ph->id }}">{{ $ph->nama_perusahaan }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 mb-3">
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
            {{-- End Modal Edit Karyawan --}}

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
        <!-- / Content -->
    <!-- Content wrapper -->
@endsection

@section ('script')
    <script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <!-- Page JS -->
    <script src="{{ asset('Template/master/js/tables-datatables-basic.js') }}"></script>
    <script src="{{ asset('Template/master/js/skp/karyawan.js') }}"></script>
@endsection