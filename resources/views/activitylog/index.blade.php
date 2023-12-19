@extends('master.template')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Activity Log</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Activity Log
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Ajax Sourced Server-side -->
            <section id="ajax-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <table id="table-activity" class="datatables-ajax table table-responsive" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Activity</th>
                                            <th>URL</th>
                                            <th>IP</th>
                                            <th>User Agent</th>
                                            <th>User Name</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Ajax Sourced Server-side -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection

@section ('script')

<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/jszip.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('Template/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(document).ready(function () {
        //MULAI DATATABLE
        //script untuk memanggil data json dari server dan menampilkannya berupa datatable
        $(document).ready(function() {
            // $.noConflict();
            $('#table-activity').DataTable({
                processing: true,
                serverSide: true, //aktifkan server-side 
                ajax: {
                    url: "/activitylog",
                    type: 'GET'
                },
                columns: [{
                        data: 'activity',
                        name: 'activity'
                    },
                    {
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'ip',
                        name: 'ip'
                    },
                    {
                        data: 'agent',
                        name: 'agent'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                ],
                order: [
                    [5, 'desc']
                ]
            });
        });
    });
</script>

@endsection