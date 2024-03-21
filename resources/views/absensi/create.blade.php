<!DOCTYPE html>
<html lang="en">
<head>
	<title>Meal Attendance - PT Santini Kelola Persada</title>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('Template/app-assets/images/ico/favicon.ico') }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/libs/toastr/toastr.css') }}" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/libs/select2/select2.css') }}" />
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('Template/master/vendor/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	<div class="full-screen flex-container-center">
		<img class="logo" src="{{ asset('Template/master/img/Logo Luwansa 2.png') }}" alt="">
		<h2 >Meal Attendance SKP</h2>
		<p>Santini Kelola Persada</p>
		<button class="button-click" onclick="closePopup()">Mulai</button>
	</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form id="formAbsensi" class="login100-form validate-form" enctype="multipart/form-data">
					{{ csrf_field() }}
					<span class="login100-form-title p-b-26">
					<p class="tanggal">Tanggal: <span id="datetime"></span></p>
						Meal Attendance SKP
					</span>
					<input type="hidden" name="id" id="id">
					{{-- <input type="hidden" name="karyawan_id" id="karyawan_id"> --}}
					<span class="login100-form-title p-b-48">
                        <img src="{{ asset('Template/master/img/Logo Luwansa 2.png') }}" alt="">
					</span>
					<div id="errorlist">
					</div>
                    <div class="wrap-input101 validate-input">
						<select class="input101 form-select" aria-label="Default select example" name="karyawan_id" id="nama_depan" required>
							<option selected disabled>Nama</option>
                            @foreach ($karyawan as $kr)
                                <option value="{{ $kr->id }}">{{ $kr->nama_depan}}</option>
                            @endforeach
						</select>
					</div>
					<div class="wrap-input101 validate-input">
						<select class="input101 form-select" id="select1" aria-label="Default select example" name="status" required>
							<option selected disabled>Status</option>
							<option value="Karyawan">Karyawan</option>
							<option value="Non Karyawan">Non Karyawan</option>
							@if($errors->has('status'))
								<div class="text-danger">
									{{ $errors->first('status')}}
								</div>
							@endif
						</select>
					</div>
					<div class="wrap-input101 validate-input">
						<input type="hidden" name="job_title" id="job_title" value=""  class="job_title form-control">
					</div>
					<div class="container-login100-form-btn mt-4">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" id="btn-simpan" class="login100-form-btn">Kirim</button>
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
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Template/master/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Template/master/vendor/libs/select2/select2.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Template/master/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('Template/master/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Template/master/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('Template/master/js/main.js') }}"></script>
	<script src="{{ asset('Template/master/js/skp/absensi-create.js') }}"></script>
</body>
</html>