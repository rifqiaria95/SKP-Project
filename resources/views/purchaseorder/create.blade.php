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
              <div class="row m-sm-4 m-0">
                <div class="col-md-7 mb-md-0 mb-4 ps-0">
                  <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                    <span class="app-brand-text fw-bold fs-4"> Purchase Order </span>
                  </div>
                </div>
                <div class="col-md-5">
                  <dl class="row mb-2">
                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                      <span class="h4 text-capitalize mb-0 text-nowrap">Nomor PO</span>
                    </dt>
                    <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                      <div class="input-group input-group-merge disabled w-px-150">
                        <span class="input-group-text">#</span>
                        <input
                          type="text"
                          name="nomor_po"
                          class="form-control ml-3"
                          placeholder=" Masukkan nomor PO"
                          id="nomor_po"
                        /> 
                      </div>
                    </dd>
                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end ps-0">
                      <span class="fw-normal">Tanggal</span>
                    </dt>
                    <dd class="col-sm-6 d-flex justify-content-md-end pe-0 ps-0 ps-sm-2">
                      <input id="tanggal" name="tanggal" type="text" class="form-control w-px-150 date-picker" placeholder="YYYY-MM-DD" />
                    </dd>
                  </dl>
                </div>
              </div>

              <hr class="my-3 mx-n4" />

                <div class="row p-sm-4 p-0">
                    <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
                    <h6 class="mb-4">Nama PO:</h6>
                    <input id="nama_po" type="text" class="form-control w-px-350" placeholder="Masukkan nama PO" />
                    </div>
                    <div class="col-md-6 col-sm-7">
                    <h6 class="mb-4">Nama Vendor:</h6>
                    <select id="nama_vendor" class="select2 form-select mb-3" required>
                        <option selected disabled>Pilih Vendor</option>
                        @foreach ($vendor as $vd)
                            <option value="{{ $vd->id }}">{{ $vd->nama_vendor }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <hr class="my-3 mx-n4" />

              <form class="source-item pt-4 px-0 px-sm-4">
                <div class="mb-3" data-repeater-list="group-a">
                  <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                    <div class="d-flex border rounded position-relative pe-0">
                      <div class="row w-100 p-3">
                        <div class="col-md-6 col-12 mb-md-0 mb-3">
                          <p class="mb-2 repeater-title">Item</p>
                          <select id="nama_item" class="select2 form-select item-details mb-3" required>
                            <option selected disabled>Pilih Item</option>
                            @foreach ($item as $itm)
                                <option value="{{ $itm->id }}">{{ $itm->nama_item }}</option>
                            @endforeach
                          </select>
                          <textarea class="form-control" rows="2" placeholder="Deskripsi item"></textarea>
                        </div>
                        <div class="col-md-3 col-12 mb-md-0 mb-3">
                          <p class="mb-2 repeater-title">Harga</p>
                          <input
                            type="number"
                            class="form-control invoice-item-price mb-3"
                            placeholder="00"
                            min="12"
                          />
                          <div>
                            <span>Discount:</span>
                            <span class="discount me-2">0%</span>
                            <span
                              class="tax-1 me-2"
                              data-bs-toggle="tooltip"
                              data-bs-placement="top"
                              title="Tax 1"
                              >0%</span
                            >
                            <span class="tax-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Tax 2"
                              >0%</span
                            >
                          </div>
                        </div>
                        <div class="col-md-2 col-12 mb-md-0 mb-3">
                          <p class="mb-2 repeater-title">Qty</p>
                          <input
                            type="number"
                            class="form-control invoice-item-qty"
                            placeholder="1"
                            min="1"
                            max="50"
                          />
                        </div>
                        <div class="col-md-1 col-12 pe-0">
                          <p class="mb-2 repeater-title">Total Harga</p>
                          <p class="mb-0"></p>
                        </div>
                      </div>
                      <div
                        class="d-flex flex-column align-items-center justify-content-between border-start p-2"
                      >
                        <i class="ti ti-x cursor-pointer" data-repeater-delete></i>
                        <div class="dropdown">
                          <i
                            class="ti ti-settings ti-xs cursor-pointer more-options-dropdown"
                            role="button"
                            id="dropdownMenuButton"
                            data-bs-toggle="dropdown"
                            data-bs-auto-close="outside"
                            aria-expanded="false"
                          >
                          </i>
                          <div
                            class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                            aria-labelledby="dropdownMenuButton"
                          >
                            <div class="row g-3">
                              <div class="col-12">
                                <label for="discountInput" class="form-label">Discount(%)</label>
                                <input
                                  type="number"
                                  class="form-control"
                                  id="discountInput"
                                  min="0"
                                  max="100"
                                />
                              </div>
                              <div class="col-md-6">
                                <label for="taxInput1" class="form-label">Tax 1</label>
                                <select name="tax-1-input" id="taxInput1" class="form-select tax-select">
                                  <option value="0%" selected>0%</option>
                                  <option value="1%">1%</option>
                                  <option value="10%">10%</option>
                                  <option value="18%">18%</option>
                                  <option value="40%">40%</option>
                                </select>
                              </div>
                              <div class="col-md-6">
                                <label for="taxInput2" class="form-label">Tax 2</label>
                                <select name="tax-2-input" id="taxInput2" class="form-select tax-select">
                                  <option value="0%" selected>0%</option>
                                  <option value="1%">1%</option>
                                  <option value="10%">10%</option>
                                  <option value="18%">18%</option>
                                  <option value="40%">40%</option>
                                </select>
                              </div>
                            </div>
                            <div class="dropdown-divider my-3"></div>
                            <button type="button" class="btn btn-label-primary btn-apply-changes">Apply</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row pb-4">
                  <div class="col-12">
                    <button type="button" class="btn btn-primary" data-repeater-create>Add Item</button>
                  </div>
                </div>
              </form>

              <hr class="my-3 mx-n4" />

              <div class="row p-0 p-sm-4">
                <div class="col-md-6 mb-md-0 mb-3">
                  <div class="d-flex align-items-center mb-3">
                    <label for="salesperson" class="form-label me-4 fw-semibold">Nama PIC:</label>
                    <input
                      id="pic"
                      type="text"
                      class="form-control"
                      placeholder="Edward Crowley"
                    />
                  </div>
                  <div class="d-flex align-items-center mb-3">
                    <label for="Jabatan" class="form-label me-4 fw-semibold">Jabatan</label>
                    <input
                      id="jabatan_pic"
                      type="text"
                      class="form-control"
                      placeholder="Edward Crowley"
                    />
                  </div>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                  <div class="invoice-calculations">
                    <div class="d-flex justify-content-between mb-2">
                      <span class="w-px-100">Subtotal:</span>
                      <span class="fw-semibold">$00.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                      <span class="w-px-100">Discount:</span>
                      <span class="fw-semibold">$00.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                      <span class="w-px-100">Tax:</span>
                      <span class="fw-semibold">$00.00</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                      <span class="w-px-100">Total:</span>
                      <span class="fw-semibold">$00.00</span>
                    </div>
                  </div>
                </div>
              </div>

              <hr class="my-3 mx-n4" />

              <div class="row px-0 px-sm-4">
                <div class="col-12">
                  <div class="mb-3">
                    <label for="note" class="form-label fw-semibold">Note:</label>
                    <textarea class="form-control" rows="2" id="note" placeholder="Purchase Order note"></textarea>
                  </div>
                </div>
              </div>
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
              <a href="./app-invoice-preview.html" class="btn btn-label-secondary d-grid w-100 mb-2">Preview</a>
              <button type="button" class="btn btn-label-secondary d-grid w-100">Save</button>
            </div>
          </div>
          <div>
            <p class="mb-2">Accept payments via</p>
            <select class="form-select mb-4">
              <option value="Bank Account">Bank Account</option>
              <option value="Paypal">Paypal</option>
              <option value="Card">Credit/Debit Card</option>
              <option value="UPI Transfer">UPI Transfer</option>
            </select>
            <div class="d-flex justify-content-between mb-2">
              <label for="payment-terms" class="mb-0">Payment Terms</label>
              <label class="switch switch-primary me-0">
                <input type="checkbox" class="switch-input" id="payment-terms" checked />
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label"></span>
              </label>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <label for="client-notes" class="mb-0">Client Notes</label>
              <label class="switch switch-primary me-0">
                <input type="checkbox" class="switch-input" id="client-notes" />
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label"></span>
              </label>
            </div>
            <div class="d-flex justify-content-between">
              <label for="payment-stub" class="mb-0">Payment Stub</label>
              <label class="switch switch-primary me-0">
                <input type="checkbox" class="switch-input" id="payment-stub" />
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label"></span>
              </label>
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