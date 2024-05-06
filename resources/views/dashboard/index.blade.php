@extends('master.template')
@section('content')
      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        @if (session('flash'))
            <div class="alert alert-success" role="alert">
                {{ session('flash') }}
            </div>
        @endif
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <!-- Website Analytics -->
            <div class="col-xl-4 col-md-6 col-12 mb-4">
              <div
                class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                id="swiper-with-pagination-cards">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="row">
                      <div class="col-12">
                        <h5 class="text-white mb-0 mt-2">Meal Attendance</h5>
                      </div>
                      <div class="row">
                        <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                          <h6 class="text-white mt-0 mt-md-3 mb-3">Total Keseluruhan</h6>
                          <div class="row">
                            <div class="col-6">
                              <ul class="list-unstyled mb-0">
                                <li class="d-flex mb-4 align-items-center">
                                  <h1 class="text-white mb-0 fw-semibold me-2 website-analytics-text-bg">
                                    @if (!totalAbsensi())
                                      {{ 0 }}
                                    @else
                                      {{ totalAbsensi() }}
                                    @endif
                                  </h1>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="row">
                      <div class="col-12">
                        <h5 class="text-white mb-0 mt-2">Karyawan</h5>
                      </div>
                      <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                        <h6 class="text-white mt-0 mt-md-3 mb-3">Total Keseluruhan</h6>
                        <div class="row">
                          <div class="col-6">
                            <ul class="list-unstyled mb-0">
                              <li class="d-flex mb-4 align-items-center">
                                <h1 class="text-white mb-0 fw-semibold me-2 website-analytics-text-bg">
                                  @if (!totalKaryawan())
                                      {{ 0 }}
                                    @else
                                      {{ totalKaryawan() }}
                                    @endif
                                </h1>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
            <!--/ Website Analytics -->

            <!-- Sales Overview -->
            <div class="col-xl-8 col-md-6 col-12 mb-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-1">Welcome {{ Auth::user()->name }}!</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex gap-2 align-items-center mb-2">
                        <p class="mb-0">A thriving hospitality brand with portfolio of city hotels and resort across Indonesia, located right at the heart of destinations where everybody is greeted with warm smiles.</p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <h1></h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <h1></h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <h1></h1>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <h1></h1>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Sales Overview -->

            <!-- Earning Reports -->
            <div class="col-lg-4 col-12 mb-4">
              <div class="card h-100">
                <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                  <div class="card-title mb-0">
                    <h5 class="mb-0">Earning Reports</h5>
                    <small class="text-muted">Weekly Earnings Overview</small>
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="earningReportsId"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsId">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                  <!-- </div> -->
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                      <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                        <h1 class="mb-0">$468</h1>
                        <div class="badge rounded bg-label-success">+4.2%</div>
                      </div>
                      <small class="text-muted">You informed of this week compared to last week</small>
                    </div>
                    <div class="col-12 col-md-8">
                      <div id="weeklyEarningReports"></div>
                    </div>
                  </div>
                  <div class="border rounded p-3 mt-2">
                    <div class="row gap-4 gap-sm-0">
                      <div class="col-12 col-sm-4">
                        <div class="d-flex gap-2 align-items-center">
                          <div class="badge rounded bg-label-primary p-1">
                            <i class="ti ti-currency-dollar ti-sm"></i>
                          </div>
                          <h6 class="mb-0">Earnings</h6>
                        </div>
                        <h4 class="my-2 pt-1">$545.69</h4>
                        <div class="progress w-75" style="height: 4px">
                          <div
                            class="progress-bar"
                            role="progressbar"
                            style="width: 65%"
                            aria-valuenow="65"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          ></div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-4">
                        <div class="d-flex gap-2 align-items-center">
                          <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                          <h6 class="mb-0">Profit</h6>
                        </div>
                        <h4 class="my-2 pt-1">$256.34</h4>
                        <div class="progress w-75" style="height: 4px">
                          <div
                            class="progress-bar bg-info"
                            role="progressbar"
                            style="width: 50%"
                            aria-valuenow="50"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          ></div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-4">
                        <div class="d-flex gap-2 align-items-center">
                          <div class="badge rounded bg-label-danger p-1">
                            <i class="ti ti-brand-paypal ti-sm"></i>
                          </div>
                          <h6 class="mb-0">Expense</h6>
                        </div>
                        <h4 class="my-2 pt-1">$74.19</h4>
                        <div class="progress w-75" style="height: 4px">
                          <div
                            class="progress-bar bg-danger"
                            role="progressbar"
                            style="width: 65%"
                            aria-valuenow="65"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          ></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Earning Reports -->

            <!-- Meal Attendance -->
            <div class="col-lg-8 col-12 mb-4">
              <div class="card">
                <div class="card-header d-flex justify-content-between pb-0">
                  <div class="card-title mb-0">
                    <h5 class="mb-0">Meal Attendance</h5>
                    @if(isset($absensi[0]))
                        <small class="text-muted">Diperbarui {{ $absensi[0]->created_at ? $absensi[0]->created_at->diffForhumans() : 'Belum ada data absensi' }}</small>
                    @else
                        <small class="text-muted">Belum ada data absensi</small>
                    @endif
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Nama</th>
                                  <th>Status</th>
                                  <th>Jabatan</th>
                                  <th>Tanggal Absensi</th>
                                  <th>Tanggal dibuat</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($absensi as $ab)
                              <tr>
                                  <td>{{ $ab->karyawan->nama_lengkap() }}</td>
                                  <td>{{ $ab->status }}</td>
                                  <td>{{ $ab->job_title }}</td>
                                  <td>{{ $ab->tanggal_absensi }}</td>
                                  <td>{{ $ab->created_at }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Meal Attendance -->

          </div>
        </div>
        <!-- / Content -->
@endsection