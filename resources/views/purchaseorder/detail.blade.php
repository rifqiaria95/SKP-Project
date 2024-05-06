@extends('master.template')
@section('content')
  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row invoice-preview">
        <!-- Invoice -->
        <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
          <div class="card invoice-preview-card">
            <div class="card-body">
              <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                <div class="mb-xl-0 mb-4">
                  <p class="mb-2">No : 019/SKP-PO/III/2024</p>
                </div>
                <div>
                  <p class="mb-2">Jakarta, 04 April 2024</p>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row p-sm-3 p-0">
                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                  <p class="mb-1">Kepada:</p>
                  <h6 class="mb-1">{{ $purchase->vendor->nama_vendor }}</h6>
                  <p class="mb-1">{{ $purchase->vendor->alamat }}</p>
                  <p class="mb-1">U.P {{ $purchase->vendor->pic }} ({{ $purchase->vendor->jabatan_pic }})</p>
                </div>
              </div>
            </div>
            <div class="table-responsive border-top">
              <table class="table m-0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga/Unit</th>
                    <th>Total Harga</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($purchase->item as $p)
                    <tr>
                      <td class="text-nowrap">{{$loop->iteration}}</td>
                      <td class="text-nowrap">{{ $p->nama_item }}</td>
                      <td class="text-nowrap">{{ $p->pivot->quantity }}</td>
                      <td class="text-nowrap">Rp {{ $p->harga }},-</td>
                      <td class="text-nowrap">Rp {{ $p->pivot->total_harga }},-</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-body mx-3">
              <div class="row">
                  <div class="col-12">
                      <span class="fw-semibold">Note:</span>
                      <div id="vendor-info" class="mt-3">
                        <ul>
                          @foreach(explode("\n", $purchase->vendor->note) as $item)
                              <li class="list-unstyled">{{ $item }}</li>
                          @endforeach
                      </ul>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Invoice -->
        <!-- Invoice Actions -->
        <div class="col-xl-3 col-md-4 col-12 invoice-actions">
          <div class="card">
            <div class="card-body">
              <button
                class="btn btn-primary d-grid w-100 mb-2"
                data-bs-toggle="offcanvas"
                data-bs-target="#sendInvoiceOffcanvas"
              >
                <span class="d-flex align-items-center justify-content-center text-nowrap">
                  <i class="ti ti-send ti-xs me-1"></i>Send Invoice
                </span>
              </button>
              <button class="btn btn-label-secondary d-grid w-100 mb-2">Download</button>
              <a
                class="btn btn-label-secondary d-grid w-100 mb-2"
                target="_blank"
                href="./app-invoice-print.html"
              >
                Print
              </a>
              <a href="./app-invoice-edit.html" class="btn btn-label-secondary d-grid w-100 mb-2">
                Edit Invoice
              </a>
              <button
                class="btn btn-primary d-grid w-100"
                data-bs-toggle="offcanvas"
                data-bs-target="#addPaymentOffcanvas"
              >
                <span class="d-flex align-items-center justify-content-center text-nowrap"
                  ><i class="ti ti-currency-dollar ti-xs me-1"></i>Add Payment</span
                >
              </button>
            </div>
          </div>
        </div>
        <!-- /Invoice Actions -->
      </div>
      <!-- Offcanvas -->
      <!-- Send Invoice Sidebar -->
      <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
        <div class="offcanvas-header my-1">
          <h5 class="offcanvas-title">Send Invoice</h5>
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
                value="Invoice of purchased Admin Templates"
                placeholder="Invoice regarding goods"
              />
            </div>
            <div class="mb-3">
              <label for="invoice-message" class="form-label">Message</label>
              <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
                Dear Queen Consolidated,
                Thank you for your business, always a pleasure to work with you!
                We have generated a new invoice in the amount of $95.59
                We would appreciate payment of this invoice by 05/11/2021
              </textarea>
            </div>
            <div class="mb-4">
              <span class="badge bg-label-primary">
                <i class="ti ti-link ti-xs"></i>
                <span class="align-middle">Invoice Attached</span>
              </span>
            </div>
            <div class="mb-3 d-flex flex-wrap">
              <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /Send Invoice Sidebar -->

      <!-- Add Payment Sidebar -->
      <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
        <div class="offcanvas-header mb-3">
          <h5 class="offcanvas-title">Add Payment</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
          <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
            <p class="mb-0">Invoice Balance:</p>
            <p class="fw-bold mb-0">$5000.00</p>
          </div>
          <form>
            <div class="mb-3">
              <label class="form-label" for="invoiceAmount">Payment Amount</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input
                  type="text"
                  id="invoiceAmount"
                  name="invoiceAmount"
                  class="form-control invoice-amount"
                  placeholder="100"
                />
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="payment-date">Payment Date</label>
              <input id="payment-date" class="form-control invoice-date" type="text" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="payment-method">Payment Method</label>
              <select class="form-select" id="payment-method">
                <option value="" selected disabled>Select payment method</option>
                <option value="Cash">Cash</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Debit Card">Debit Card</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Paypal">Paypal</option>
              </select>
            </div>
            <div class="mb-4">
              <label class="form-label" for="payment-note">Internal Payment Note</label>
              <textarea class="form-control" id="payment-note" rows="2"></textarea>
            </div>
            <div class="mb-3 d-flex flex-wrap">
              <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /Add Payment Sidebar -->
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
@endsection