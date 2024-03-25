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
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul">Tambah Purchase Order</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formPurchase" class="card-body" enctype="multipart/form-data">
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
                                        <option value="0">Pending</option>
                                        <option value="1">Selesai</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="multicol-first-name">Perusahaan</label>
                                    <select name="perusahaan_id" class="select2 form-select mb-3" required>
                                        <option selected disabled>Pilih Perusahaan</option>
                                        @foreach ($perusahaan as $ps)
                                            <option value="{{ $ps->id }}">{{ $ps->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Vendor</h6>
                            <div class="row g-3">
                              <div class="col-12">
                                <label class="form-label" for="multicol-first-name">Nama Vendor</label>
                                <select name="vendor_id" class="select2 form-select mb-3" required>
                                    <option selected disabled>Pilih Vendor</option>
                                    @foreach ($vendor as $vd)
                                        <option value="{{ $vd->id }}">{{ $vd->nama_vendor }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Item</h6>
                            <div class="row g-3">
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-first-name">Nama Item</label>
                                <select name="item" class="select2 form-select mb-3" required>
                                    <option selected disabled>Pilih Item</option>
                                    @foreach ($item as $itm)
                                        <option value="{{ $itm->id }}">{{ $itm->nama_item }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Harga</label>
                                <input
                                  type="text"
                                  name="harga"
                                  class="form-control hargak "
                                  placeholder="Masukkan harga item"
                                  aria-label="Masukkan harga item"
                                />
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Quantity</label>
                                <input
                                  type="text"
                                  name="quantity"
                                  class="form-control quantity"
                                  placeholder="Masukkan quantity"
                                  aria-label="Masukkan quantity"
                                />
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Total Harga</label>
                                <input
                                  type="text"
                                  name="total_harga"
                                  class="form-control total_harga"
                                  placeholder="Total Harga"
                                  aria-label="Total Harga"
                                />
                              </div>
                              <div class="col-md-6 select2-primary">
                                <label class="form-label" for="multicol-language">PPN</label>
                                <input
                                  type="text"
                                  name="ppn"
                                  class="form-control ppn"
                                  placeholder="PPN 11%"
                                  aria-label="PPN 11%"
                                />
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-birthdate">Grand Total</label>
                                <input
                                  type="text"
                                  name="grand_total"
                                  class="form-control grand_total"
                                  placeholder="Manager"
                                />
                              </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                                </button>
                              <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Tambah PO --}}

            <!-- Modal Edit purchase -->
            <div class="modal fade text-start" id="editModal" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal-judul">Tambah Purchase Order</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEdit" name="formEdit" class="card-body" enctype="multipart/form-data">
                            @csrf
                            <h6>Detail PO</h6>
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->name }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-username">Nomor PO</label>
                                    <input type="text" name="nomor_po" id="nomor_po" class="form-control" placeholder="#001" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="multicol-email">Nama PO</label>
                                    <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="nama_po"
                                        id="nama_po"
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
                                        <input id="tanggal" name="tanggal" type="text" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" />
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-password-toggle">
                                    <label class="form-label" for="multicol-confirm-password">Status</label>
                                    <select class="select form-select" name="status" id="status">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Selesai</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="multicol-first-name">Perusahaan</label>
                                    <select name="perusahaan_id" id="perusahaan_id" class="select2 form-select mb-3" required>
                                        <option selected disabled>Pilih Perusahaan</option>
                                        @foreach ($perusahaan as $ps)
                                            <option value="{{ $ps->id }}">{{ $ps->nama_perusahaan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Vendor</h6>
                            <div class="row g-3">
                              <div class="col-12">
                                <label class="form-label" for="multicol-first-name">Nama Vendor</label>
                                <select name="vendor_id" id="vendor_id" class="select2 form-select mb-3" required>
                                    <option selected disabled>Pilih Vendor</option>
                                    @foreach ($vendor as $vd)
                                        <option value="{{ $vd->id }}">{{ $vd->nama_vendor }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            <hr class="my-4 mx-n4" />
                            <h6>Detail Item</h6>
                            <div class="row g-3">
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-first-name">Nama Item</label>
                                <select id="item" name="item" class="select2 form-select mb-3" required>
                                    <option selected disabled>Pilih Item</option>
                                    @foreach ($item as $itm)
                                        <option value="{{ $itm->id }}">{{ $itm->nama_item }}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Harga</label>
                                <input
                                  type="text"
                                  id="harga"
                                  name="harga"
                                  class="form-control harga"
                                  placeholder="Masukkan harga item"
                                  aria-label="Masukkan harga item"
                                />
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Quantity</label>
                                <input
                                  type="text"
                                  id="quantity"
                                  name="quantity"
                                  class="form-control quantity"
                                  placeholder="Masukkan quantity"
                                  aria-label="Masukkan quantity"
                                />
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-phone">Total Harga</label>
                                <input
                                  type="text"
                                  id="total_harga"
                                  name="total_harga"
                                  class="form-control total_harga"
                                  placeholder="Total Harga"
                                  aria-label="Total Harga"
                                />
                              </div>
                              <div class="col-md-6 select2-primary">
                                <label class="form-label" for="multicol-language">PPN</label>
                                <input
                                  type="text"
                                  id="ppn"
                                  name="ppn"
                                  class="form-control ppn"
                                  placeholder="PPN 11%"
                                  aria-label="PPN 11%"
                                />
                              </div>
                              <div class="col-md-6">
                                <label class="form-label" for="multicol-birthdate">Grand Total</label>
                                <input
                                  type="text"
                                  id="grand_total"
                                  name="grand_total"
                                  class="form-control grand_total"
                                  placeholder="Manager"
                                />
                              </div>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Simpan
                                </button>
                              <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
            {{-- End Modal Edit Karyawan --}}
            </div>
        </div>
        <!-- / Content -->
@endsection

@section ('script')
    <script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <!-- Page JS -->
    <script src="{{ asset('Template/master/js/tables-datatables-basic.js') }}"></script>
    <script src="{{ asset('Template/master/js/skp/purchase.js') }}"></script>
{{-- 
    <script>
        $("#rowAdder").click(function () {
            newRowAdd =
                '<label class="form-label mt-3">Nama Item</label>' +
                '<select class="select2 form-select" name="nama_item" id="selectItem" required>' +
                    '<option selected disabled>Pilih Item</option>' + 
                    '@foreach ($item as $itm)' +
                    '<option value="{{ $itm->id }}">{{ $itm->nama_item }}</option>' +
                    '@endforeach' +
                '</select>';
 
            $('#newInput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteRow", function () {
            $(this).parents("#row").remove();
        })
    </script> --}}
@endsection