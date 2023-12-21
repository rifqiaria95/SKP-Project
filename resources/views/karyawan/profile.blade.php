@extends('master.template')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="app-user-view">
                <!-- User Card & Plan Starts -->
                <div class="row">
                    <!-- User Card starts-->
                    <div class="col-xl-9 col-lg-8 col-md-7">
                        <div class="card user-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 d-flex flex-column justify-content-between border-container-lg">
                                        <div class="user-avatar-section">
                                            <div class="d-flex justify-content-start">
                                                <img class="img-fluid rounded" src="{{ $karyawan->getAvatar() }}" height="104" width="104" alt="User avatar" />
                                                <div class="d-flex flex-column ms-1">
                                                    <div class="user-info mb-1">
                                                        <h4 class="mb-0">{{ $karyawan->nama_lengkap() }}</h4>
                                                        <span class="card-text">{{ $karyawan->user->email }}</span>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <a href="./app-user-edit.html" class="btn btn-primary">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center user-total-numbers">
                                            <div class="d-flex align-items-center me-2">
                                                <div class="color-box bg-light-primary">
                                                    <i data-feather="dollar-sign" class="text-primary"></i>
                                                </div>
                                                <div class="ms-1">
                                                    <h5 class="mb-0">23.3k</h5>
                                                    <small>Monthly Sales</small>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="color-box bg-light-success">
                                                    <i data-feather="trending-up" class="text-success"></i>
                                                </div>
                                                <div class="ms-1">
                                                    <h5 class="mb-0">$99.87K</h5>
                                                    <small>Annual Profit</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 mt-2 mt-xl-0">
                                        <div class="user-info-wrapper">
                                            <h4 class="mb-1">Account Details</h4>
                                            <div class="d-flex flex-wrap">
                                                <div class="user-info-title">
                                                    <i data-feather="user" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Name</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $karyawan->user->name }}</p>
                                            </div>
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="check" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Status</span>
                                                </div>
                                                <p class="card-text mb-0">
                                                    @if ($karyawan->user->status_user === 1) 
                                                        Active
                                                    @elseif ($karyawan->user->status_user === 0) 
                                                        Inactive
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="d-flex flex-wrap my-50">
                                                <div class="user-info-title">
                                                    <i data-feather="star" class="me-1"></i>
                                                    <span class="card-text user-info-title fw-bold mb-0">Role</span>
                                                </div>
                                                <p class="card-text mb-0">{{ $karyawan->user->role }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card Ends-->
                    
                    <!-- Plan Card starts-->
                    <div class="col-xl-3 col-lg-4 col-md-5">
                        <div class="card plan-card border-primary">
                            <div class="card-header d-flex justify-content-between align-items-center pt-75 pb-1">
                                <h5 class="mb-0">Current Plan</h5>
                                <span class="badge badge-light-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Expiry Date">July 22, <span class="nextYear"></span>
                                </span>
                            </div>
                            <div class="card-body">
                                <span class="badge badge-light-primary">Basic</span>
                                <ul class="list-unstyled my-1">
                                    <li>
                                        <span class="align-middle">5 Users</span>
                                    </li>
                                    <li class="my-25">
                                        <span class="align-middle">10 GB storage</span>
                                    </li>
                                    <li>
                                        <span class="align-middle">Basic Support</span>
                                    </li>
                                </ul>
                                <button class="btn btn-primary text-center w-100">Upgrade Plan</button>
                            </div>
                        </div>
                    </div>
                    <!-- /Plan CardEnds -->
                </div>
                <!-- User Card & Plan Ends -->
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Karyawan</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-center" data-bs-toggle="pill" href="#home-center" aria-expanded="true"><i data-feather="info" class="me-1"></i> Biodata</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-center" data-bs-toggle="pill" href="#profile-center" aria-expanded="false"><i data-feather="briefcase" class="me-1"></i> Informasi Karyawan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="about-tab-center" data-bs-toggle="pill" href="#about-center" aria-expanded="false"><i data-feather="share-2" class="me-1"></i> Social Media</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home-center" aria-labelledby="home-tab-center" aria-expanded="true">
                                        <h5 class="mb-75">Nama Lengkap:</h5>
                                        <p class="card-text">
                                            {{ $karyawan->nama_lengkap() }}
                                        </p>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Tempat Tanggal Lahir:</h5>
                                            <p class="card-text">{{ $karyawan->tempat_lahir }} {{ $karyawan->tanggal_lahir }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Alamat:</h5>
                                            <p class="card-text">New York, USA</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Jenis Kelamin:</h5>
                                            <p class="card-text">{{ $karyawan->jenis_kelamin }}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile-center" role="tabpanel" aria-labelledby="profile-tab-center" aria-expanded="false">
                                        <p>
                                            Pudding candy canes sugar plum cookie chocolate cake powder croissant. Carrot cake tiramisu danish candy
                                            cake muffin croissant tart dessert. Tiramisu caramels candy canes chocolate cake sweet roll liquorice
                                            icing cupcake.Bear claw chocolate chocolate cake jelly-o pudding lemon drops sweet roll sweet candy.
                                            Chocolate sweet chocolate bar candy chocolate bar chupa chups gummi bears lemon drops.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="about-center" role="tabpanel" aria-labelledby="about-tab-center" aria-expanded="false">
                                        <p>
                                            Carrot cake dragée chocolate. Lemon drops ice cream wafer gummies dragée. Chocolate bar liquorice
                                            cheesecake cookie chupa chups marshmallow oat cake biscuit. Dessert toffee fruitcake ice cream powder
                                            tootsie roll cake.Chocolate bonbon chocolate chocolate cake halvah tootsie roll marshmallow. Brownie
                                            chocolate toffee toffee jelly beans bonbon sesame snaps sugar plum candy canes.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Informasi Rekening</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills justify-content-center">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab-center" data-bs-toggle="pill" href="#home-center" aria-expanded="true"><i data-feather="info" class="me-1"></i> Biodata</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab-center" data-bs-toggle="pill" href="#profile-center" aria-expanded="false"><i data-feather="briefcase" class="me-1"></i> Informasi Karyawan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="about-tab-center" data-bs-toggle="pill" href="#about-center" aria-expanded="false"><i data-feather="share-2" class="me-1"></i> Social Media</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home-center" aria-labelledby="home-tab-center" aria-expanded="true">
                                        <h5 class="mb-75">Nama Lengkap:</h5>
                                        <p class="card-text">
                                            {{ $karyawan->nama_lengkap() }}
                                        </p>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Tempat Tanggal Lahir:</h5>
                                            <p class="card-text">{{ $karyawan->tempat_lahir }} {{ $karyawan->tanggal_lahir }}</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Alamat:</h5>
                                            <p class="card-text">New York, USA</p>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="mb-75">Jenis Kelamin:</h5>
                                            <p class="card-text">{{ $karyawan->jenis_kelamin }}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile-center" role="tabpanel" aria-labelledby="profile-tab-center" aria-expanded="false">
                                        <p>
                                            Pudding candy canes sugar plum cookie chocolate cake powder croissant. Carrot cake tiramisu danish candy
                                            cake muffin croissant tart dessert. Tiramisu caramels candy canes chocolate cake sweet roll liquorice
                                            icing cupcake.Bear claw chocolate chocolate cake jelly-o pudding lemon drops sweet roll sweet candy.
                                            Chocolate sweet chocolate bar candy chocolate bar chupa chups gummi bears lemon drops.
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="about-center" role="tabpanel" aria-labelledby="about-tab-center" aria-expanded="false">
                                        <p>
                                            Carrot cake dragée chocolate. Lemon drops ice cream wafer gummies dragée. Chocolate bar liquorice
                                            cheesecake cookie chupa chups marshmallow oat cake biscuit. Dessert toffee fruitcake ice cream powder
                                            tootsie roll cake.Chocolate bonbon chocolate chocolate cake halvah tootsie roll marshmallow. Brownie
                                            chocolate toffee toffee jelly beans bonbon sesame snaps sugar plum candy canes.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection