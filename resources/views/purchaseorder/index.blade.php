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
                        <span>Total PO</span>
                        <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2"></h4>
                        </div>
                        <span>Diperbarui </span>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="ti ti-user ti-sm"></i>
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
                        <span>Paid Users</span>
                        <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2">4,567</h4>
                        <span class="text-success">(+18%)</span>
                        </div>
                        <span>Last week analytics </span>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                        <i class="ti ti-user-plus ti-sm"></i>
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
                        <span>PO Selesai</span>
                        <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2"></h4>
                        </div>
                        <span>Diperbarui </span>
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class="ti ti-user-check ti-sm"></i>
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
                        <span>PO Pending</span>
                        <div class="d-flex align-items-center my-1">
                        <h4 class="mb-0 me-2"></h4>
                        </div>
                        <span>Diperbarui </span>
                    </div>
                    <span class="badge bg-label-warning rounded p-2">
                        <i class="ti ti-user-exclamation ti-sm"></i>
                    </span>
                    </div>
                </div>
                </div>
            </div>
            </div>
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
                <table id="table-purchase" class="datatables-users table border-top">
                <thead>
                    <tr>
                        <th>Nomor PO</th>
                        <th>Nama PO</th>
                        <th>Tanggal</th>
                        <th>Created By</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                </table>
            </div>
            
            <!-- Modal Tambah purchase -->
            <div class="modal fade text-start" id="tambahModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul">Tambah Purchase Order</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formPurchase" class="card-body source-item" enctype="multipart/form-data">
                            @csrf
                            <h6>Detail PO</h6>
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-username">Nomor PO</label>
                                    <input type="text" name="nomor_po" class="form-control" placeholder="#001" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-email">Nama PO</label>
                                    <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="nama_po"
                                        class="form-control"
                                        placeholder="Masukkan nama PO"
                                        aria-label="Masukkan nama PO"
                                        aria-describedby="nama_po"
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                    <label class="form-label" for="multicol-password">Tanggal</label>
                                    <div class="input-group input-group-merge">
                                        <input name="tanggal" type="text" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" />
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                    <label class="form-label" for="multicol-confirm-password">Status</label>
                                    <select class="select form-select" name="status">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="multicol-first-name">Perusahaan</label>
                                    <select class="select2 form-select" id="selectPerusahaan" name="perusahaan_id" required>
                                        <option selected disabled>Pilih Perusahaan</option>
                                        @foreach ($perusahaan as $ps)
                                            <option value="{{ $ps->id }}">{{ $ps->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label" for="multicol-first-name">PIC 1</label>
                                    <select id="selectKR1" name="pic_1" class="select2 form-select" required>
                                        <option selected disabled>Pilih PIC 1</option>
                                        @foreach ($karyawan as $kr)
                                            <option value="{{ $kr->id }}">{{ $kr->nama_depan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label" for="multicol-first-name">PIC 2</label>
                                    <select id="selectKR2" name="pic_2" class="select2 form-select mb-3" required>
                                        <option selected disabled>Pilih PIC 1</option>
                                        @foreach ($karyawan as $kr)
                                            <option value="{{ $kr->id }}">{{ $kr->nama_depan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Vendor</h6>
                            <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="multicol-first-name">Nama Vendor</label>
                                <select id="selectVendor" name="vendor_id" class="select2 form-select" required>
                                    <option selected disabled>Pilih Vendor</option>
                                    @foreach ($vendor as $vd)
                                        <option value="{{ $vd->id }}">{{ $vd->nama_vendor }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Item</h6>
                            <div id="repeater2" class="mb-3" data-repeater-list="group-a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div id="rowAja" class="row w-100 p-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="multicol-first-name">Nama Item</label>
                                                <select name="item[]" id="getItem1" class="select2 form-select" required>
                                                    <option selected disabled>Pilih Item</option>
                                                    @foreach ($item as $itm)
                                                        <option value="{{ $itm->id }}">{{ $itm->nama_item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                <label class="form-label" for="multicol-phone">Harga</label>
                                                <input
                                                type="text"
                                                id="getHarga"
                                                class="form-control harga"
                                                placeholder="Harga item"
                                                aria-label="Masukkan quantity"
                                                readonly="readonly"
                                                />
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                <label class="form-label" for="multicol-phone">Quantity</label>
                                                <input
                                                type="text"
                                                name="quantity[]"
                                                class="form-control quantity"
                                                placeholder="1"
                                                aria-label="Masukkan quantity"
                                                />
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <label class="form-label" for="multicol-phone">Total</label>
                                                <input
                                                type="text"
                                                name="total_harga[]"
                                                class="form-control total_harga"
                                                placeholder="Total Harga"
                                                aria-label="Total Harga"
                                                readonly="readonly"
                                                />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                            <i class="ti ti-x cursor-pointer" data-repeater-delete></i>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div id="repeater" class="mb-3" data-repeater-list="group-a">

                                </div>
                                <div class="row pb-4">
                                <div class="col-12">
                                    <button id="addItem" type="button" class="btn btn-primary" data-repeater-create>Add Item</button>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <div class="row p-0 p-sm-4">
                                <div class="col-md-6 mb-md-0 mb-3">
                                <div class="d-flex align-items-center mb-3">
                                    <input
                                    type="hidden"
                                    name="ppn"
                                    value="11"
                                    class="form-control ms-3 ppn"
                                    id="salesperson"
                                    />
                                </div>
                                <input
                                    type="hidden"
                                    name="grand_total"
                                    value="150000"
                                    class="form-control grand_total"
                                    id="invoiceMsg"
                                />
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <div class="invoice-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Subtotal:</span>
                                        <span class="fw-semibold total_harga_all"></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">PPN:</span>
                                        <span class="fw-semibold">11%</span>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between">
                                        <span class="w-px-100">Grand Total:</span>
                                        <span class="fw-semibold grand_total"></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                            </button>
                            <button type="reset" class="btn btn-label-secondary mx-3">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Tambah PO --}}

            <!-- Modal Edit purchase -->
            <div class="modal fade text-start" id="editModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul">Edit Purchase Order</h4>
                            <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEdit" name="formEdit" class="card-body source-item" enctype="multipart/form-data">
                            @csrf
                            <h6>Detail PO</h6>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-username">Nomor PO</label>
                                    <input type="text" id="nomor_po" name="nomor_po" class="form-control" placeholder="#001" value="" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-email">Nama PO</label>
                                    <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="nama_po"
                                        id="nama_po"
                                        value=""
                                        class="form-control"
                                        placeholder="Masukkan nama PO"
                                        aria-label="Masukkan nama PO"
                                        aria-describedby="nama_po"
                                    />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                    <label class="form-label" for="multicol-password">Tanggal</label>
                                    <div class="input-group input-group-merge">
                                        <input id="tanggal" name="tanggal" type="text" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" value="" />
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                    <label class="form-label" for="multicol-confirm-password">Status</label>
                                    <select id="status" class="select form-select" name="status">
                                        <option selected disabled value="">Pilih Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="multicol-first-name">Perusahaan</label>
                                    <select class="select2 form-select" id="perusahaan_id" name="perusahaan_id" required>
                                        <option selected disabled>Pilih Perusahaan</option>
                                        @foreach ($perusahaan as $ps)
                                            <option value="{{ $ps->id }}">{{ $ps->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <label class="form-label" for="multicol-first-name">PIC 1</label>
                                    <select id="pic_1" name="pic_1" class="select2 form-select" required>
                                        <option selected disabled>Pilih PIC 1</option>
                                        @foreach ($karyawan as $kr)
                                            <option value="{{ $kr->id }}">{{ $kr->nama_depan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="form-label" for="multicol-first-name">PIC 2</label>
                                    <select id="pic_2" name="pic_2" class="select2 form-select mb-3" required>
                                        <option selected disabled>Pilih PIC 1</option>
                                        @foreach ($karyawan as $kr)
                                            <option value="{{ $kr->id }}">{{ $kr->nama_depan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Vendor</h6>
                            <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label" for="multicol-first-name">Nama Vendor</label>
                                <select id="vendor_id" name="vendor_id" class="select2 form-select" required>
                                    <option selected disabled>Pilih Vendor</option>
                                    @foreach ($vendor as $vd)
                                        <option value="{{ $vd->id }}">{{ $vd->nama_vendor }}</option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Item</h6>
                            <div id="itemContainer" class="mb-3" data-repeater-list="group-a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div id="rowAja" class="row w-100 p-3">
                                            <div class="col-md-4">
                                                <label class="form-label" for="multicol-first-name">Nama Item</label>
                                                <select name="item[]" id="getItem3" class="select2 form-select" required>
                                                    <option selected disabled>Pilih Item</option>
                                                    @foreach ($item as $itm)
                                                        <option value="{{ $itm->id }}">{{ $itm->nama_item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                
                                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                <label class="form-label" for="multicol-phone">Harga</label>
                                                <input type="text" id="getHarga2" class="form-control harga" value="" placeholder="Harga item" aria-label="Masukkan quantity" readonly="readonly" />
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                <label class="form-label" for="multicol-phone">Quantity</label>
                                                <input type="text" id="quantity" name="quantity[]" class="form-control" placeholder="1" value="" aria-label="Masukkan quantity" />
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <label class="form-label" for="multicol-phone">Total</label>
                                                <input type="text" id="total_harga" name="total_harga[]" class="form-control" value="" placeholder="Total Harga" aria-label="Total Harga" readonly="readonly" />
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                            <i class="ti ti-x cursor-pointer delete-item" data-item-id=""></i>
                                        </div>                                
                                    </div>
                                </div>
                            </div>
                            <div id="repeaterEdit" class="mb-3" data-repeater-list="group-a">
                                
                            </div>
                            <div class="row pb-4">
                                <div class="col-12">
                                    <button id="addItem2" type="button" class="btn btn-primary" data-repeater-create>Add Item</button>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <div class="row p-0 p-sm-4">
                                <div class="col-md-6 mb-md-0 mb-3">
                                <div class="d-flex align-items-center mb-3">
                                    <input
                                    type="hidden"
                                    id="ppn"
                                    name="ppn"
                                    value=""
                                    class="form-control ms-3"
                                    />
                                </div>
                                <input
                                    type="hidden"
                                    name="grand_total"
                                    id="grand_total1"
                                    value=""
                                    class="form-control grand_total"
                                />
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <div class="invoice-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Subtotal:</span>
                                        <span class="fw-semibold total_harga_all"></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">PPN:</span>
                                        <span class="fw-semibold">11%</span>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between">
                                        <span class="w-px-100">Grand Total:</span>
                                        <span id="grand_total2" class="fw-semibold grand_total"></span>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn-update" value="create">Simpan
                            </button>
                            <button type="reset" class="btn btn-label-secondary mx-3">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Edit Purchase --}}

            <!-- Modal Konfirmasi Delete -->
            <div class="modal fade" tabindex="-1" role="dialog" id="modalHapus" data-backdrop="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">PERHATIAN</h5>
                        </div>
                        <div class="modal-body">
                            <p><b>Jika menghapus purchase order maka</b></p>
                            <p>*data purchase order tersebut hilang selamanya, apakah anda yakin?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" id="btn-hapus" data-target="#btn-hapus" class="btn btn-danger tambah_data" value="add">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{-- End Modal Konfirmasi Delete --}}
            </div>
        </div>
        <!-- / Content -->
@endsection

@section ('script')
    <script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/master/js/tables-datatables-basic.js') }}"></script>
    <script src="{{ asset('Template/master/js/skp/purchase.js') }}"></script>

    <script>
        var items = {!! json_encode($item) !!};
    </script>
@endsection