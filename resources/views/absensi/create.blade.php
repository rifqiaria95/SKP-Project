<!DOCTYPE html>
<html lang="en">
<head>
	<title>Meal Attendance - PT Santini Kelola Persada</title>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('Template/app-assets/images/ico/favicon.ico') }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--===============================================================================================-->	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('FrontEnd/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	<div class="full-screen flex-container-center">
		<img class="logo" src="{{ asset('FrontEnd/images/Logo Luwansa 2.png') }}" alt="">
		<h2 >Meal Attendance SKP</h2>
		<p>Santini Kelola Persada</p>
		<button class="button-click" onclick="closePopup()">Mulai</button>
	</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="formKaryawan" class="login100-form validate-form" enctype="multipart/form-data">
					{{ csrf_field() }}
					<span class="login100-form-title p-b-26">
					<p class="tanggal">Tanggal: <span id="datetime"></span></p>
						Meal Attendance SKP
					</span>
					<input type="hidden" name="id" id="id">
					{{-- <input type="hidden" name="karyawan_id" id="karyawan_id"> --}}
					<span class="login100-form-title p-b-48">
                        <img src="{{ asset('FrontEnd/images/Logo Luwansa 2.png') }}" alt="">
					</span>
					<div id="errorlist">
					</div>
                    <div class="wrap-input101 validate-input">
						<select class="input101 form-select" aria-label="Default select example" name="karyawan_id">
							<option selected disabled>Nama</option>
                            @foreach ($karyawan as $kr)
                                <option value="{{ $kr->id }}">{{ $kr->nama_depan ?? '' }}</option>
                            @endforeach
						</select>
					</div>
					<div class="wrap-input101 validate-input">
						{{-- <input id="cb1" value="karyawan" class="form-check-input" type="radio" name="status"> --}}
						<select class="input101 form-select" id="select1" aria-label="Default select example" name="status">
							<option selected disabled>Status</option>
							<option value="karyawan">Karyawan</option>
							<option value="supir">Supir</option>
							@if($errors->has('status'))
								<div class="text-danger">
									{{ $errors->first('status')}}
								</div>
							@endif
						</select>
						<div class="form-check mt-4">
							<input id="cb2" class="form-check-input" type="radio" name="status" value="lainnya">
							<label class="form-check-label">
								Lainnya
							</label>
							@if($errors->has('lainnya'))
								<div class="text-danger">
									{{ $errors->first('lainnya')}}
								</div>
							@endif
						</div>
					<div>
					<div id="form1" class="wrap-input100" style="display:none">
						<input class="input100" type="text" name="status_manual">
						<span class="input100"></span>
						@if($errors->has('status'))
							<div class="text-danger">
								{{ $errors->first('status')}}
							</div>
						@endif
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" id="btn-simpan" class="login100-form-btn" value="Simpan">Kirim</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Luwansa Hotels Group
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('FrontEnd/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/js/main.js') }}"></script>

	<script>
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

		$(document).ready(function(){
			$("#cb2").click(function(e){
				$('#form1').show();
				$( "#select1" ).val('');
			});
			$("#select1").click(function(e){
				$( "#cb2" ).prop( "checked", false );
				$('#form1').hide().find('input').val('');
			});
		});

		$(document).ready(function () {
			//SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
			//jika id = formKaryawan panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
			//jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
			if ($("#formKaryawan").length > 0) {
				$("#formKaryawan").validate({
					submitHandler: function(form) {
						var actionType = $('#btn-simpan').val();
						// Mengubah data menjadi objek agar file image bisa diinput kedalam database
						var formData = new FormData($('#formKaryawan')[0]);
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
										$('#errorlist').append('<div class="alert-body d-flex align-items-center"><i data-feather="info" class="me-50"></i><span>' + err_value +
											'</span></div>');
									});

									$('#btn-simpan').text('Mengirim..');
								
								// console.log(response.status);
								} else if (response.status == 409) {
									setTimeout(function(){ // wait for 2 secs(2)
										location.reload(); // then reload the page.(3)
									}, 2000); 
									$('#formKaryawan').find('input').val('');
									toastr.error(response.errors);
								} else if (response.status == 200) {
									setTimeout(function(){ // wait for 5 secs(2)
										location.reload(); // then reload the page.(3)
									}, 5000); 
									$('#modalJudul').html("");
									$('#formKaryawan').find('input').val('');
									toastr.success(response.message + response.timestamp);

									$('#tambahModal').modal('hide');
								}
							},
							error: function(response) {
								// console.log('Error:', response);
								$('#btn-simpan').html('Simpan');
							}
						});
					}
				})
			}
		});
	</script>

</body>
</html>