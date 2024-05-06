@extends('master.template')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Vendor /</span>PT Santini Kelola Persada</h4>
            <!-- DataTable with Buttons -->
            <div class="card">
                <div class="card-body mt-4">
                    <button type="button" id="btn_tambah" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="menu-icon tf-icons ti ti-plus"></i> Tambah Data</button>
                    <a href="/vendor/exportexcelvendor" class="btn btn-success mb-5"><i class="menu-icon tf-icons ti ti-file-x"></i> Export Excel</a>
                    <a href="/vendor/exportpdf" class="btn btn-danger mb-5"><i class="menu-icon tf-icons ti ti-file-text"></i> Export PDF</a>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="table-vendor" class="invoice-list-table table border-top">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>PIC</th>
                                <th>Jabatan PIC</th>
                                <th>Note</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Modal Tambah vendor -->
            <div class="modal fade text-start" id="tambahModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formVendor" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Vendor</label>
                                        <input type="text" name="nama_vendor" class="nama_vendor form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="alamat form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" name="no_tlp" class="no_tlp form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">PIC</label>
                                        <input type="text" name="pic" class="pic form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Jabatan PIC</label>
                                        <input type="text" name="jabatan_pic" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Note</label>
                                        <textarea type="text" name="note" class="note form-control editor"></textarea>
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
            {{-- End Modal Tambah Vendor --}}

            <!-- Modal Edit vendor -->
            <div class="modal fade text-start" id="editModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="titleEdit"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEdit" name="formEdit" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Vendor</label>
                                        <input type="text" id="nama_vendor" name="nama_vendor" class="nama_vendor form-control" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Alamat</label>
                                        <input type="text" id="alamat" name="alamat" class="alamat form-control" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" id="no_tlp" name="no_tlp" class="no_tlp form-control" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">PIC</label>
                                        <input type="text" id="pic" name="pic" class="pic form-control" value="" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Jabatan PIC</label>
                                        <input type="text" id="jabatan_pic" name="jabatan_pic" class="form-control" value="">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Note</label>
                                        <textarea type="text" id="note" name="note" class="note form-control editor" value=""></textarea>
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
            {{-- End Modal Tambah Vendor --}}

            <!-- Modal Konfirmasi Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PERHATIAN</h5>
                        </div>
                        <div class="modal-body">
                            <p><b>Jika menghapus vendor maka</b></p>
                            <p>*data vendor tersebut hilang selamanya, apakah anda yakin?</p>
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
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<!-- Page JS -->
<script src="{{ asset('Template/master/js/tables-datatables-basic.js') }}"></script>
<script src="{{ asset('Template/master/js/skp/vendor.js') }}"></script>

<script>
    ClassicEditor
            .create( document.querySelector( '.editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endsection