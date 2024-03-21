@extends('master.template')
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Activity Log</h4>
            <!-- DataTable with Buttons -->
            <div class="card">
                <div class="card-body">
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table id="table-activity" class="datatables-ajax table">
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
        <!-- / Content -->
    <!-- Content wrapper -->
@endsection

@section ('script')

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