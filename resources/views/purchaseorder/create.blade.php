@extends('master.template')
@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row invoice-add">
        <!-- Purchase Order Add-->
        <div class="col-lg-9 col-12 mb-lg-0 mb-4">
          <div class="card invoice-preview-card">
            <div class="card-body">
              <div class="card-title">
                <h4 class="modal-title" id="modal-judul">Tambah Purchase Order</h4>
              </div>
              <div class="row m-sm-4 m-0">
                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                </div>
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
        <!-- /Purchase Order Add-->

        <!-- Purchase Order Actions -->
        <div class="col-lg-3 col-12 invoice-actions">
          <div class="card mb-4">
            <div class="card-body">
              <button
                class="btn btn-primary d-grid w-100 mb-2"
                data-bs-toggle="offcanvas"
                data-bs-target="#sendPurchase OrderOffcanvas"
              >
                <span class="d-flex align-items-center justify-content-center text-nowrap"
                  ><i class="ti ti-send ti-xs me-1"></i>Send Purchase Order</span
                >
              </button>
              <a href="/purchaseorder/detail" class="btn btn-label-secondary d-grid w-100 mb-2">Preview</a>
            </div>
          </div>
        </div>
        <!-- /Purchase Order Actions -->
      </div>

      <!-- Offcanvas -->
      <!-- Send Purchase Order Sidebar -->
      <div class="offcanvas offcanvas-end" id="sendPurchase OrderOffcanvas" aria-hidden="true">
        <div class="offcanvas-header my-1">
          <h5 class="offcanvas-title">Send Purchase Order</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>
        <div class="offcanvas-body pt-0 flex-grow-1">
          <form>
            <div class="mb-3">
              <label for="invoice-from" class="form-label">From</label>
              <input
                type="text"
                class="form-control"
                id="invoice-from"
                value="shelbyComapny@email.com"
                placeholder="company@email.com"
              />
            </div>
            <div class="mb-3">
              <label for="invoice-to" class="form-label">To</label>
              <input
                type="text"
                class="form-control"
                id="invoice-to"
                value="qConsolidated@email.com"
                placeholder="company@email.com"
              />
            </div>
            <div class="mb-3">
              <label for="invoice-subject" class="form-label">Subject</label>
              <input
                type="text"
                class="form-control"
                id="invoice-subject"
                value="Purchase Order of purchased Admin Templates"
                placeholder="Purchase Order regarding goods"
              />
            </div>
            <div class="mb-3">
              <label for="invoice-message" class="form-label">Message</label>
              <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
Dear Queen Consolidated,
  Thank you for your business, always a pleasure to work with you!
  We have generated a new invoice in the amount of $95.59
  We would appreciate payment of this invoice by 05/11/2021</textarea

              >
            </div>
            <div class="mb-4">
              <span class="badge bg-label-primary">
                <i class="ti ti-link ti-xs"></i>
                <span class="align-middle">Purchase Order Attached</span>
              </span>
            </div>
            <div class="mb-3 d-flex flex-wrap">
              <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /Send Purchase Order Sidebar -->

      <!-- /Offcanvas -->
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->
@endsection

@section ('script')
  <script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>

  <script src="{{ asset('Template/master/js/skp/purchase.js') }}"></script>

  <script>
      var items = {!! json_encode($item) !!};
  </script>
@endsection