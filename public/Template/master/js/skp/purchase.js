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
    $('#table-purchase').DataTable({
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
            text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Tambah PO</span>',
            className: 'btn_tambah add-new btn btn-primary mx-3',
            attr: {
                'data-bs-toggle': 'modal',
                'data-bs-target': '#tambahModal'
            } 
        }
        ],
        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
            url: "/purchaseorder",
            type: 'GET'
        },
        columns: [{
                data: 'nomor_po',
                name: 'nomor_po'
            },
            {
                data: 'nama_po',
                name: 'nama_po'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
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
        
    });
});


// Function untuk tombol tambah purchase dan tampilkan modal
$(document).ready(function() {
    // $.noConflict();
    $('#btn_tambah').click(function() {
        // console.log($('#btn_tambah'));
        $('#btn-simpan').val("tambah-purchase");
        $('#purchase_id').val('');
        $('#tambahModal').modal('show');
        $('#formPurchase').trigger("reset");
        $('#modal-judul').html("Tambah PO");
        $('#selectJK').select2({
            dropdownParent: $('#tambahModal')
        });
        $('#selectPerusahaan').select2({
            dropdownParent: $('#tambahModal')
        });
    });
});

//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
//jika id = formPurchase panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
if ($("#formPurchase").length > 0) {
    $("#formPurchase").validate({
        submitHandler: function(form) {
            var actionType = $('#btn-simpan').val();
            // Mengubah data menjadi objek agar file image bisa diinput kedalam database
            var formData = new FormData($('#formPurchase')[0]);
            $.ajax({
                data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                url: "/purchaseorder/store", //url simpan data
                type: "POST", //data tipe kita kirim berupa JSON
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var oTable = $('#table-purchase').dataTable(); //inialisasi datatable
                    oTable.fnDraw(false); //reset datatable
                    if (response.status == 400) {
                        $('#save_errorList').html("");
                        $('#save_errorList').removeClass('d-none');
                        $.each(response.errors, function(key, err_value) {
                            $('#save_errorList').append('<li>' + err_value +
                                '</li>');
                        });

                        $('#btn-simpan').text('Menyimpan..');
                    } else if (response.status == 200) {
                        $('#modalJudul').html("");
                        $('#formPurchase').find('input').val('');
                        toastr.success(response.message);
                        $('#tambahModal').modal('hide');

                    }
                },
                error: function(response) {
                    console.log('Error:', response);
                    $('#btn-simpan').html('Simpan');
                }
            });
        }
    })
}

// Function get job title
$(document).on('change', '#nama_vendor', function(e) {
    e.preventDefault();

    var id  = $(this).val();
    var url =  "/purchaseorder/getDetail/" + id,
    url 	= url.replace(':id', id);

    $.ajax({
        type    : "GET",
        url     : url,
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Jika sukses maka munculkan notifikasi
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
            } else {
                $('#id').val(id);
                $('#pic').val(response.pic).trigger('change');
                $('#jabatan_pic').val(response.jabatan_pic);
                $('#no_tlp').val(response.no_tlp);
                $('#alamat').val(response.alamat);
                $('#note').val(response.note);
            }
        },
        error: function(jqXHR, exception) {
            // console.log(response);
            alert(jqXHR.responseText);
        }
    });

});

// Function get detail item
$(document).on('change', '#nama_item', function(e) {
    e.preventDefault();

    var id  = $(this).val();
    var url =  "/purchaseorder/getDetailItem/" + id,
    url 	= url.replace(':id', id);

    $.ajax({
        type    : "GET",
        url     : url,
        dataType: 'json',
        success: function(response) {
            // console.log(response);
            // Jika sukses maka munculkan notifikasi
            if (response.status == 404) {
                $('#success_message').addClass('alert alert-success');
                $('#success_message').text(response.message);
            } else {
                $('#id').val(id);
                $('#spesifikasi_item').val(response.spesifikasi_item);
                $('#note').val(response.note);
            }
        },
        error: function(jqXHR, exception) {
            // console.log(response);
            alert(jqXHR.responseText);
        }
    });

});

// Function kalkulasi item + hitung pajak
$('#harga, #quantity').on('change', function(){
    var quantity    = $('#quantity').val();
    var harga       = $('#harga').val();
    var tax         = 11
    var grand_total = (harga * tax) / 100;
    
    harga = Number(harga.toLocaleString().replace(/[^0-9\.-]+/g,""));
    console.log(harga);
    
    if(isNaN(harga) || isNaN(quantity)){
		$('#total_harga').val('');
		return;
	}
	
	total       = quantity * harga;
	grand_total = total * tax;
	total       = Math.round((total + Number.EPSILON) * 100) / 100;

	$('#total_harga').val(total.toLocaleString());
	$('#grand_total').val(grand_total.toLocaleString());
});