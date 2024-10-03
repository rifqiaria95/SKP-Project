@extends('master.template')
@section('content')

        <!-- Content wrapper -->
        <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Total Assets</span>
                        <div class="d-flex align-items-center my-1">
                        {{-- <h4 class="mb-0 me-2">{{ totalUser() }}</h4> --}}
                        </div>
                        {{-- <span>Diperbarui {{ $inventory[0]->created_at->diffForhumans() }}</span> --}}
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="ti ti-inventory ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Paid Items</span>
                        <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">4,567</h4>
                        <span class="text-success">(+18%)</span>
                        </div>
                        <span>Last week analytics </span>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                        <i class="ti ti-inventory-plus ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Active Items</span>
                        <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">{{ totalActiveUser() }}</h4>
                        </div>
                        {{-- <span>Diperbarui {{ $inventory[0]->updated_at->diffForhumans() }}</span> --}}
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class="ti ti-inventory-check ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Inactive Items</span>
                        <div class="d-flex align-items-center my-1">
                        {{-- <h4 class="mb-0 me-2">{{ totalInactiveUser() }}</h4> --}}
                        </div>
                        {{-- <span>Diperbarui {{ $inventory[0]->updated_at->diffForhumans() }}</span> --}}
                    </div>
                    <span class="badge bg-label-warning rounded p-2">
                        <i class="ti ti-inventory-exclamation ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- Items List Table -->
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
                <table id="table-inventory" class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th>Nama Asset</th>
                        <th>Image</th>
                        <th>Tag</th>
                        <th>Serial</th>
                        <th>Category</th>
                        <th>Purchase Cost</th>
                        <th>Location</th>
                        <th>Owned By</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                </table>
            </div>
            <!-- Modal Tambah Inventory -->
            {{-- <div class="modal fade text-start" id="tambahModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul"></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formItem" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Inventory</label>
                                        <input type="text" name="nama_item" class="nama_item form-control" placeholder="Masukkan Nama Inventory" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Harga</label>
                                        <input type="text" name="harga" class="harga form-control" placeholder="Masukkan Harga" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Spesifikasi</label>
                                        <textarea class="form-control" name="spesifikasi_item" placeholder="Masukkan Spesifkasi Inventory" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Note</label>
                                        <textarea class="form-control" placeholder="Masukkan Note" name="note"></textarea>
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
            </div> --}}
            {{-- End Modal Tambah Inventory --}}

            <!-- Modal Edit inventory -->
            {{-- <div class="modal fade text-start" id="editModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
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
                                        <label class="form-label">Nama</label>
                                        <input type="text" id="name" name="name" class="name form-control" value="" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="email form-control" value="" required>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Role</label>
                                            <select class="select2 form-select" name="role" id="role" required>
                                                <option>Pilih Role</option>
                                                <option value="owner">Owner</option>
                                                <option value="admin">Admin</option>
                                                <option value="karyawan">Karyawan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Status</label>
                                            <select class="select2 form-select" name="status_user" id="status_user" required>
                                                <option>Pilih Role</option>
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 mb-3">
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
            </div> --}}
            {{-- End Modal Tambah Inventory --}}

            <!-- Modal Konfirmasi Delete -->
            {{-- <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
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
            </div> --}}
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
    <script src="{{ asset('Template/master/js/skp/inventory.js') }}"></script>
@endsection