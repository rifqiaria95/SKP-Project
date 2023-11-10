<!DOCTYPE html>
<html lang="en">
<head>
	<title>PT Santini Kelola Persada</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<!--===============================================================================================-->	
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
		@if (\Session::has('error'))
			<div class="alert alert-danger alert-block">
				<ul class="alert-danger">
					<li>{!! \Session::get('error') !!}</li>
				</ul>
			</div>
		@endif
		@if (\Session::has('success'))
			<div class="alert alert-success alert-block-lg">
				<ul class="alert-sukses">
					<li class="alert-sukses1">{!! \Session::get('success') !!} {{ date ('d/m/Y H:i')}}</li>
				</ul>
			</div>
		@endif
	</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="/absensi/store" class="login100-form validate-form">
					{{ csrf_field() }}
					<span class="login100-form-title p-b-26">
					<p class="tanggal">Tanggal: <span id="datetime"></span></p>
						Meal Attendance SKP
					</span>
					<input type="hidden" name="ip" value="">
					<span class="login100-form-title p-b-48">
                        <img src="{{ asset('FrontEnd/images/Logo Luwansa 2.png') }}" alt="">
					</span>
                    <div class="wrap-input101 validate-input">
						<select class="input101 form-select" aria-label="Default select example" name="nama" required>
							<option selected disabled>Nama</option>
							<option value="Budi Utomo Al Sunardi">Budi</option>
							<option value="Hanes Saragih">Hanes</option>
							<option value="Julian Parananda">Julian</option>
							<option value="Jefry Lucky">Jefry</option>
							<option value="Nila Anggraeni">Nila</option>
							<option value="Ramson Ambarita">Ramson</option>
							<option value="Rifqi Aria">Rifqi</option>
							<option value="Ris Erdima P">Ris</option>
							<option value="Ronal">Ronal</option>
							<option value="Robert Siboro">Robert</option>
							<option value="Supri Budi Handoyo">Supri</option>
						</select>
						@if($errors->has('nama'))
							<div class="text-danger">
								{{ $errors->first('nama')}}
							</div>
						@endif
					</div>
					<div class="container-cb1">
						<div class="form-check">
							<input id="cb1" value="karyawan" class="form-check-input" type="radio" name="status">
							<label class="form-check-label" for="flexRadioDefault1">
								Karyawan/ti
							</label>
							@if($errors->has('status'))
								<div class="text-danger">
									{{ $errors->first('status')}}
								</div>
							@endif
						</div>
						<div class="form-check">
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
						<span class="input100" data-placeholder=""></span>
						@if($errors->has('status'))
							<div class="text-danger">
								{{ $errors->first('status')}}
							</div>
						@endif
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" value="Simpan">Kirim</button>
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
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('FrontEnd/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('FrontEnd/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
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
		const popup = document.querySelector(".full-screen, .button-click");

		function closePopup(){
		popup.classList.add('hidden');

		var dt = new Date();
		document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"."+ (("0"+(dt.getMonth()+1)).slice(-2)) +"."+ (dt.getFullYear()) +" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
		}
	</script>

	<script>
		$(document).ready(function(){
			$("#cb2").click(function(e){
				$('#form1').show();
				$( "#cb1" ).prop( "checked", false );
			});
			$("#cb1").click(function(e){
				$('#form1').hide();
				$( "#cb2" ).prop( "checked", false );
			});
		});
	</script>

</body>
</html>