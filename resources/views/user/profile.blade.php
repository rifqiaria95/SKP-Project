@extends('master.template')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">User /</span> Profile</h4>
        <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
            <div class="card-body">
                <div class="user-avatar-section">
                <div class="d-flex align-items-center flex-column">
                    <img
                    class="img-fluid rounded mb-3 pt-1 mt-4"
                    src="{{ $user->getAvatar() }}"
                    height="100"
                    width="100"
                    alt="User avatar"
                    />
                    <div class="user-info text-center">
                    <h4 class="mb-2">{{ $user->name }}</h4>
                    <span class="badge bg-label-secondary mt-1">{{ $user->role }}</span>
                    </div>
                </div>
                </div>
                <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                <div class="d-flex align-items-start me-4 mt-3 gap-2">
                    <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-checkbox ti-sm"></i></span>
                    <div>
                    <p class="mb-0 fw-semibold">1.23k</p>
                    <small>Tasks Done</small>
                    </div>
                </div>
                <div class="d-flex align-items-start mt-3 gap-2">
                    <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-briefcase ti-sm"></i></span>
                    <div>
                    <p class="mb-0 fw-semibold">568</p>
                    <small>Projects Done</small>
                    </div>
                </div>
                </div>
                <p class="mt-4 small text-uppercase text-muted">Details</p>
                <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-2">
                    <span class="fw-semibold me-1">Name:</span>
                    <span>{{ $user->name }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Email:</span>
                    <span>{{ $user->email }}</span>
                    </li>
                    <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Status:</span>
                    <span
                    class="@if ($user->status_user === 0)
                            badge bg-label-danger
                            @else
                            badge bg-label-success
                            @endif
                            ">
                    @if ($user->status_user === 0)
                        Inactive
                    @else
                        Active
                    @endif
                    </span>
                    </li>
                    <li class="mb-2 pt-1">
                    <span class="fw-semibold me-1">Role:</span>
                    <span>{{ $user->role }}</span>
                    </li>
                </ul>
                <div class="d-flex justify-content-center">
                    <a
                        href="javascript:;"
                        data-id="{{ $user->id }}"
                        class="edit-user btn btn-primary me-3"
                        data-bs-target="#editModal"
                        data-bs-toggle="modal"
                        >Change Password</a
                    >
                </div>
                </div>
            </div>
            </div>
            <!-- /User Card -->
            <!-- Plan Card -->
            <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                <span class="badge bg-label-primary">Standard</span>
                <div class="d-flex justify-content-center">
                    <sup class="h6 pricing-currency mt-3 mb-0 me-1 text-primary fw-normal">$</sup>
                    <h1 class="fw-semibold mb-0 text-primary">99</h1>
                    <sub class="h6 pricing-duration mt-auto mb-2 text-muted fw-normal">/month</sub>
                </div>
                </div>
                <ul class="ps-3 g-2 my-3">
                <li class="mb-2">10 Users</li>
                <li class="mb-2">Up to 10 GB storage</li>
                <li>Basic Support</li>
                </ul>
                <div class="d-flex justify-content-between align-items-center mb-1 fw-semibold text-heading">
                <span>Days</span>
                <span>65% Completed</span>
                </div>
                <div class="progress mb-1" style="height: 8px">
                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: 65%"
                    aria-valuenow="65"
                    aria-valuemin="0"
                    aria-valuemax="100"
                ></div>
                </div>
                <span>4 days remaining</span>
                <div class="d-grid w-100 mt-4">
                <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                    Upgrade Plan
                </button>
                </div>
            </div>
            </div>
            <!-- /Plan Card -->
        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

            <!-- Project table -->
            <div class="card mb-4">
            <h5 class="card-header">User's Projects List</h5>
            <div class="table-responsive mb-3">
                <table class="table datatable-project border-top">
                <thead>
                    <tr>
                    <th></th>
                    <th>Project</th>
                    <th class="text-nowrap">Total Task</th>
                    <th>Progress</th>
                    <th>Hours</th>
                    </tr>
                </thead>
                </table>
            </div>
            </div>
            <!-- /Project table -->

            <!-- Activity Timeline -->
            <div class="card mb-4">
            <h5 class="card-header">User Activity Timeline</h5>
            <div class="card-body pb-0">
                <ul class="timeline mb-0">
                <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-primary"></span>
                    <div class="timeline-event">
                    <div class="timeline-header mb-1">
                        <h6 class="mb-0">12 Invoices have been paid</h6>
                        <small class="text-muted">12 min ago</small>
                    </div>
                    <p class="mb-2">Invoices have been paid to the company</p>
                    <div class="d-flex">
                        <a href="javascript:void(0)" class="me-3">
                        <img
                            src="{{ asset('Template/master/img/icons/misc/pdf.png') }}"
                            alt="PDF image"
                            width="15"
                            class="me-2"
                        />
                        <span class="fw-semibold text-heading">invoices.pdf</span>
                        </a>
                    </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-warning"></span>
                    <div class="timeline-event">
                    <div class="timeline-header mb-1">
                        <h6 class="mb-0">Client Meeting</h6>
                        <small class="text-muted">45 min ago</small>
                    </div>
                    <p class="mb-2">Project meeting with john @10:15am</p>
                    <div class="d-flex flex-wrap">
                        <div class="avatar me-3">
                        <img src="{{ asset('Template/master/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div>
                        <h6 class="mb-0">Lester McCarthy (Client)</h6>
                        <small>CEO of Pixinvent</small>
                        </div>
                    </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-transparent">
                    <span class="timeline-point timeline-point-info"></span>
                    <div class="timeline-event">
                    <div class="timeline-header mb-1">
                        <h6 class="mb-0">Create a new project for client</h6>
                        <small class="text-muted">2 Day Ago</small>
                    </div>
                    <p class="mb-2">5 team members in a project</p>
                    <div class="d-flex align-items-center avatar-group">
                        <div
                        class="avatar pull-up"
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        title="Vinnie Mostowy"
                        >
                        <img src="{{ asset('Template/master/img/avatars/5.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div
                        class="avatar pull-up"
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        title="Marrie Patty"
                        >
                        <img src="{{ asset('Template/master/img/avatars/12.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div
                        class="avatar pull-up"
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        title="Jimmy Jackson"
                        >
                        <img src="{{ asset('Template/master/img/avatars/9.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div
                        class="avatar pull-up"
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        title="Kristine Gill"
                        >
                        <img src="{{ asset('Template/master/img/avatars/6.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                        <div
                        class="avatar pull-up"
                        data-bs-toggle="tooltip"
                        data-popup="tooltip-custom"
                        data-bs-placement="top"
                        title="Nelson Wilson"
                        >
                        <img src="{{ asset('Template/master/img/avatars/4.png') }}" alt="Avatar" class="rounded-circle" />
                        </div>
                    </div>
                    </div>
                </li>
                <li class="timeline-item timeline-item-transparent border-0">
                    <span class="timeline-point timeline-point-success"></span>
                    <div class="timeline-event">
                    <div class="timeline-header mb-1">
                        <h6 class="mb-0">Design Review</h6>
                        <small class="text-muted">5 days Ago</small>
                    </div>
                    <p class="mb-0">Weekly review of freshly prepared design for our new app.</p>
                    </div>
                </li>
                </ul>
            </div>
            </div>
            <!-- /Activity Timeline -->

            <!-- Invoice table -->
            <div class="card mb-4">
            <div class="table-responsive mb-3">
                <table class="table datatable-invoice border-top">
                <thead>
                    <tr>
                    <th></th>
                    <th>ID</th>
                    <th><i class="ti ti-trending-up"></i></th>
                    <th>Total</th>
                    <th>Issued Date</th>
                    <th>Actions</th>
                    </tr>
                </thead>
                </table>
            </div>
            </div>
            <!-- /Invoice table -->
        </div>
        <!--/ User Content -->
        </div>

        <!-- Modal -->
        <!-- Edit User Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <input type="hidden" name="id" id="id">
                <ul class="alert alert-warning d-none" id="modalJudulEdit"></ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                <h3 class="mb-2">Edit User Password</h3>
                <p class="text-muted">Updating user password will receive a privacy audit.</p>
                </div>
                <form id="formEdit" name="formEdit" enctype="multipart/form-data" class="row g-3" onsubmit="return false">
                    @csrf
                    <div class="col-12">
                        <label class="form-label" for="modalEditUserLastName">New Password</label>
                        <input
                        type="password"
                        id="password"
                        name="password"
                        class="password form-control"
                        value=""
                        />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button
                        type="reset"
                        class="btn btn-label-secondary"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                        >
                        Cancel
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!--/ Edit User Modal -->

        <!-- /Modal -->
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection

@section('script')
    <script src="{{ asset('Template/master/js/skp/user.js') }}"></script>
@endsection