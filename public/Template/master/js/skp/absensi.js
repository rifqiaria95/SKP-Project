$(document).ready(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
          // Function datepicker
          $( function() {
              $( "#tanggal_awal" ).datepicker({
                  "dateFormat": "dd-mm-yy"
              });
              $( "#tanggal_akhir" ).datepicker({
                  "dateFormat": "dd-mm-yy"
              });
              $( "#tanggal_absensi_tambah" ).datepicker({
                  "dateFormat": "dd-mm-yy"
              });
          });
  
          //MULAI DATATABLE
          //script untuk memanggil data json dari server dan menampilkannya berupa datatable
          function fetch(tanggal_awal, tanggal_akhir) {
              var table = $('#table-absensi').DataTable({
                  dom          : '<"card-body border-bottom p-10"<"dt-action-buttons text-start"B>><"d-flex justify-content-start float-left mx-0 row"<"col-sm-3 col-md-6"l><"col-sm-3 col-md-6"f>>t<"d-flex justify-content-start mx-0 row"<"col-sm-3 col-md-6"i><"col-sm-3 col-md-6"p>>',
                  displayLength: 7, // Show entries
                  lengthMenu   : [7, 10, 25, 50, 75, 100], // Show entries option
                  buttons      : [
                      {
                          extend   : 'copy',
                          text     : feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                      },
                      {
                          extend   : 'csv',
                          text     : feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                      },
                      {
                          extend   : 'excel',
                          text     : feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                      },
                      {
                          extend   : 'pdf',
                          text     : feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                      },
                  ],
                  processing: true,
                  serverSide: true,        //Aktifkan server-side
                  ajax: {
                      url     : "/absensi",
                      type    : 'GET',
                      data    : {
                          tanggal_awal : tanggal_awal,
                          tanggal_akhir: tanggal_akhir
                      },
                  },
                  columns: [{
                          data: 'karyawan',
                          name: 'karyawan'
                      },
                      {
                          data: 'status',
                          name: 'status'
                      },
                      {
                          data: 'job_title',
                          name: 'job_title'
                      },
                      {
                          data: 'tanggal_absensi',
                          name: 'tanggal_absensi'
                      },
                      {
                          data: 'created_at',
                          name: 'created_at'
                      },
                      {
                          data: 'aksi',
                          name: 'aksi'
                      },
                  ],
                  order: [
                      [4, 'desc']
                  ]
              });
          }
          fetch();
  
          // Function untuk mengubah datatable berdasarkan tanggal yang dipilih
          $("#tanggal_akhir").on("change", function(e) {
              e.preventDefault();
              var tanggal_awal = $("#tanggal_awal").val();
              var tanggal_akhir = $("#tanggal_akhir").val();
              if (tanggal_awal == "" || tanggal_akhir == "") {
                  alert("Both date required");
              } else {
                  $('#table-absensi').DataTable().destroy();
                  fetch(tanggal_awal, tanggal_akhir);
              }
          });
  
          // Reset
          $("#btn_reset").on("click", function(e) {
              e.preventDefault();
              $("#tanggal_awal").val(''); // empty value
              $("#tanggal_akhir").val('');
              $('#table-absensi').DataTable().destroy();
              fetch();
          });
  
      });
  
      // Function untuk tombol tambah absensi dan tampilkan modal
      $(document).ready(function() {
          // $.noConflict();
          $('#btn_tambah').click(function() {
              // console.log($('#btn_tambah'));
              $('#btn-simpan').val("tambah-absensi");
              // $('#karyawan_id').val('');
              $('#tambahModal').modal('show');
              $('#formAbsensi').trigger("reset");
              $('#modal-judul').html("Tambah Absensi");
              $('#optionKaryawan').select2({
                  dropdownParent: $('#tambahModal')
              });
              $('#optionPosisi').select2({
                  dropdownParent: $('#tambahModal')
              });
          });
  
      });
  
      //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
      //jika id = formAbsensi panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
      //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
      if ($("#formAbsensi").length > 0) {
          $("#formAbsensi").validate({
              submitHandler: function(form) {
                  var actionType = $('#btn-simpan').val();
                  // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                  var formData = new FormData($('#formAbsensi')[0]);
                  $.ajax({
                      data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                      url: "/absensi/store", //url simpan data
                      type: "POST", //data tipe kita kirim berupa JSON
                      contentType: false,
                      processData: false,
                      success: function(response) {
                          var oTable = $('#table-absensi').dataTable(); //inialisasi datatable
                          oTable.fnDraw(false); //reset datatable
                          if (response.status == 400) {
                              $('#save_errorList').html("");
                              $('#save_errorList').removeClass('d-none');
                              $.each(response.errors, function(key, err_value) {
                                  $('#save_errorList').append('<li>' + err_value +
                                      '</li>');
                              });
  
                              $('#btn-simpan').text('Menyimpan..');
                          
                          // console.log(response.status);
                          } else if (response.status == 409) {
                              $('#formAbsensi').find('input').val('');
                              toastr.error(response.errors);
                              $('#tambahModal').trigger('click');
  
                          } else if (response.status == 200) {
                              $('#modalJudul').html("");
                              $('#formAbsensi').find('input').val('');
                              toastr.success(response.message + response.timestamp);
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
  
      // Function Edit Absensi
      $(document).on('click', '.edit-absensi', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#editModal').modal('show');
            $('#titleEdit').html("Edit Data Absensi");
            $('#karyawan_id').select2({
                dropdownParent: $('#editModal')
            });

            $.ajax({
                type: "GET",
                url: "/absensi/edit/" + id,
                success: function(response) {
                    // console.log(response);
                    // Jika sukses maka munculkan notifikasi
                    if (response.status == 404) {
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#editModal').modal('hide');
                    } else {
                        $('#id').val(id);
                        $('#karyawan_id').val(response.karyawan_id).trigger('change');
                        $('#status').val(response.status);
                        $('#job_title').val(response.job_title);
                        $('#tanggal_absensi').val(response.tanggal_absensi);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            });
            $('.btn-close').find('input').val('');

        });
  
      // Function Update Data Absensi
      $(document).on('submit', '#formEdit', function(e) {
          e.preventDefault();
          var id = $('#id').val();
  
          // Mengubah data menjadi objek agar file image bisa diinput kedalam database
          var EditFormData = new FormData($('#formEdit')[0]);
  
          $.ajax({
              type: "POST",
              url: "/absensi/update/" + id,
              data: EditFormData,
              contentType: false,
              processData: false,
              success: function(response) {
                  console.log(response);
                  var oTable = $('#table-absensi').dataTable(); //inialisasi datatable
                  oTable.fnDraw(false); //reset datatable
                  if (response.status == 400) {
                      $('#modalJudulEdit').html("");
                      $('#modalJudulEdit').removeClass('d-none');
                      $.each(response.errors, function(key, err_value) {
                          $('#modalJudulEdit').append('<li>' + err_value +
                              '</li>');
                      });
  
                      $('#btn-update').text('Update');
                  } else if (response.status == 404) {
                      toastr.success(response.message);
                  } else if (response.status == 200) {
                      $('#modalJudulEdit').html("");
                      toastr.success(response.message);
  
                      $('#editModal').modal('hide');
                  }
              },
              error: function(response) {
                  console.log('Error:', response);
              }
          });
  
      });
  
      // Function Delete
      //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
      $('body').on('click', '.delete', function() {
          id = $(this).attr('id');
          $('#modalHapus').modal('show');
      });
      //jika tombol hapus pada modal konfirmasi di klik maka
      $('#btn-hapus').click(function(e) {
          e.preventDefault();
          $.ajax({
              url: "/absensi/delete/" + id, //eksekusi ajax ke url ini
              type: 'delete',
              beforeSend: function() {
                  $('#btn-hapus').text('Hapus Data...'); //set text untuk tombol hapus
              },
              success: function(response) { //jika sukses
                  setTimeout(function() {
                      $('#modalHapus').modal('hide');
                      var oTable = $('#table-absensi').dataTable();
                      oTable.fnDraw(false); //reset datatable
                      if (response.status == 404) {
                          toastr.success(response.message);
                      } else if (response.status == 200) {
                          toastr.success(response.message);
                      }
                  });
              },
              error: function(response) {
                  console.log('Error:', response);
              }
          })
      });