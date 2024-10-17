$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

//MULAI DATATABLE
//script untuk memanggil data json dari server dan menampilkannya berupa datatable
$(document).ready(function() {
    // $.noConflict();
    var tableOptions = {
        dom:
            '<"row me-2"' +
            '<"col-md-2"<"me-3"l>>' +
            '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
            '>t' +
            '<"row mx-2"' +
            '<"col-sm-12 col-md-6"i>' +
            '<"col-sm-12 col-md-6"p>' +
            '>',
        language: {
            sLengthMenu: '_MENU_',
            search: '',
            searchPlaceholder: 'Search..'
        },
        buttons: [
            {
                extend: 'collection',
                className: 'btn btn-label-secondary dropdown-toggle mx-3',
                text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="ti ti-printer me-2" ></i>Print',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be print
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        },
                        customize: function (win) {
                        //customize print view for dark
                        $(win.document.body)
                            .css('color', headingColor)
                            .css('border-color', borderColor)
                            .css('background-color', bodyBg);
                        $(win.document.body)
                            .find('table')
                            .addClass('compact')
                            .css('color', 'inherit')
                            .css('border-color', 'inherit')
                            .css('background-color', 'inherit');
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="ti ti-file-text me-2" ></i>Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="ti ti-copy me-2" ></i>Copy',
                        className: 'dropdown-item',
                        exportOptions: {
                        columns: [1, 2, 3, 4, 5],
                        // prevent avatar to be display
                        format: {
                            body: function (inner, coldex, rowdex) {
                            if (inner.length <= 0) return inner;
                            var el = $.parseHTML(inner);
                            var result = '';
                            $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('item-name')) {
                                result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                result = result + item.textContent;
                                } else result = result + item.innerText;
                            });
                            return result;
                            }
                        }
                        }
                    }
                ]
            },
            {
                text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add Task</span>',
                className: 'btn_tambah add-new btn btn-primary mx-3',
                attr: {
                    'data-bs-toggle': 'tambahModal',
                    'data-bs-target': '#tambahModal'
                }
            }
        ],
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "/task",
            type: 'GET'
        },
        columns: [{
                data: 'title',
                name: 'title'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'deadline',
                name: 'deadline'
            },
            {
                data: 'priority',
                name: 'priority'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'user',
                name: 'user'
            },
            {
                data: 'aksi',
                name: 'aksi'
            },
        ],
        order: [
            [0, 'asc']
        ],
    };

    $('#table-task').DataTable(tableOptions);
});