@extends('master.template')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Perusahaan</h4>
        <!-- Users List Table -->
        <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-3">Search Filter</h5>
            <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role"></div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table id="table-perusahaan" class="datatables-users table border-top">
            <thead>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Alamat Perusahaan</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            </table>
        </div>
        <!-- Modal Tambah perusahaan -->
        <div class="modal fade text-start" id="tambahModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-judul"></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formPerusahaan" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="user_id" id="user_id">
                            <ul id="save_errorList"></ul>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" name="nama_perusahaan" class="nama_perusahaan form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alamat</label>
                                    <textarea type="text" name="alamat_perusahaan" class="alamat_perusahaan form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Tlp</label>
                                    <input type="text" name="no_tlp_perusahaan" class="no_tlp_perusahaan form-control" required>
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
        {{-- End Modal Tambah Perusahaan --}}

        <!-- Modal Edit perusahaan -->
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
                                <div class="col-12">
                                    <label class="form-label">Nama Perusahaan</label>
                                    <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="nama_perusahaan form-control" value="" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alamat</label>
                                    <textarea type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="alamat_perusahaan form-control" value="" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. Tlp</label>
                                    <input type="text" id="no_tlp_perusahaan" name="no_tlp_perusahaan" class="no_tlp_perusahaan form-control" value="" required>
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
        {{-- End Modal Edit Perusahaan --}}

        <!-- Modal Konfirmasi Delete -->
        <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">PERHATIAN</h5>
                    </div>
                    <div class="modal-body">
                        <p><b>Jika menghapus perusahaan maka</b></p>
                        <p>*data perusahaan tersebut hilang selamanya, apakah anda yakin?</p>
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
@endsection

@section ('script')
    <script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <!-- Page JS -->
    <script src="{{ asset('Template/master/js/tables-datatables-basic.js') }}"></script>
    <script src="{{ asset('Template/master/js/skp/perusahaan.js') }}"></script>
@endsection