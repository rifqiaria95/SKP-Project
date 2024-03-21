$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
const popup = document.querySelector(".full-screen, .button-click");

function closePopup(){
popup.classList.add('hidden');

var dt = new Date();
document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
}

// Function get job title
$(document).on('change', '#nama_depan', function(e) {
    e.preventDefault();

    var id  = $(this).val();
    var url =  "/absensi/gettitle/" + id,
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
                $('#job_title').val(response.job_title).trigger('change');
            }
        },
        error: function(jqXHR, exception) {
            // console.log(response);
            alert(jqXHR.responseText);
        }
    });

});

$(document).ready(function () {
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
                        if (response.status == 400) {
                            $('#errorlist').html("");
                            $('#errorlist').addClass('class="alert alert-danger mb-3 alert-validation-msg" role="alert"');
                            $.each(response.errors, function(key, err_value) {
                                $('#errorlist').append('<div class="alert-body d-flex align-items-center"><i data-feather="info" class="me-50"></i><span>' + err_value + '</span></div>');
                            });

                            $('#btn-simpan').text('Mengirim..');
                        
                        // console.log(response.status);
                        } else if (response.status == 409) {
                            setTimeout(function(){ // wait for 2 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 2000); 
                            $('#formAbsensi').find('input').val('');
                            toastr.error(response.errors);
                        } else if (response.status == 200) {
                            setTimeout(function(){ // wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 5000); 
                            $('#modalJudul').html("");
                            $('#formAbsensi').find('input').val('');
                            toastr.success(response.message + response.timestamp);
                        }
                    },
                    error: function(jqXHR, exception) {
                        // console.log(response.errors);
                        alert(jqXHR.responseText);
                        // $('#btn-simpan').html('Kirim');
                    }
                });
            }
        })
    }
});