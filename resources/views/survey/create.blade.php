@extends('layouts.app')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="image-hero col-lg-8 col-sm-3 pt-5 mx-auto">
                        <img class="card-img-top" src="{{ asset('Template/app-assets/images/profile/user-uploads/timeline.jpg') }}" alt="User Profile Image">
                    </div>
                </div>
                <div class="row">
                    <div class="survey-content col-lg-8 col-sm-3 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div id="errorlist">
                                <p class="card-text mt-3">Thank you for taking the time to review your stay at our hotel! Your personal feedback will help us improve and will allow future guests to get to know us better. We sincerely appreciate your time. Please note that our evaluation system uses a scoring scale from 1 (inadequate) to 5 (excellent).</p>
                                <form id="formSurvey" class="form-horizontal" enctype="multipart/form-data">
                                    <div class="row form-survey g-3 mt-5">
                                        <div class="col-md-12">
                                            <label class="form-label">Your overall experience score : *</label>
                                            <div class="star-rating2 mt-2">
                                                <select class="star" id="stars" name="experience_score">
                                                    <option class="star1" value="20">1</option>
                                                    <option class="star2" value="40">2</option>
                                                    <option class="star3" value="60">3</option>
                                                    <option class="star4" value="80">4</option>
                                                    <option class="star5" value="100">5</option>  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Brief description about your experience with us</label>
                                            <textarea type="textarea" name="description" class="description form-control">
                                            </textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Your suggestion for us to improve our service :</label>
                                            <textarea type="text" name="suggestion" class="suggestion form-control">
                                            </textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">How likely are you to recommend us to your friends or colleagues?</label>
                                            <div class="star-rating2 mt-2">
                                                <select class="star" id="stars2" name="recommend">
                                                    <option class="star1" value="20">1</option>
                                                    <option class="star2" value="40">2</option>
                                                    <option class="star3" value="60">3</option>
                                                    <option class="star4" value="80">4</option>
                                                    <option class="star5" value="100">5</option>  
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <h2 class="mt-5 text-center">Your Experience</h2>
                                        <div class="demo-inline-spacing" style="margin: auto">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb1" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Arrival</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb2" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Service</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb3" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Room</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb4" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">F&B</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb5" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Facilities</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb6" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Cleanliness</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb7" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Atmosphere</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb8" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Check-out</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb9" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">WiFi</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="cb10" value="unchecked" />
                                                <label class="form-check-label" for="inlineCheckbox2">Value for money</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-arrival">
                                        <h4>Arrival</h4>
                                        <p>Check-in Experience</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars3" name="arrival">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-service">
                                        <h4>Service</h4>
                                        <p>Friendliness of our staff</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars4" name="service">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-room">
                                        <h4>Room</h4>
                                        <p>Room Maintenance</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars5" name="room">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-fb">
                                        <h4>Food & Beverages</h4>
                                        <p>All - day dining experience</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars6" name="fb">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-facilities">
                                        <h4>Facilities</h4>
                                        <p>Room</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars7" name="facilities">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-cleanliness">
                                        <h4>Cleanliness</h4
                                        <p>Room</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars8" name="cleanliness">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-atmosphere">
                                        <h4>Atmosphere</h4>
                                        <p>Entertainment program</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars9" name="atmosphere">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-checkout">
                                        <h4>Check-out</h4>
                                        <p>Check-out efficiency</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars9" name="checkout">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-wifi">
                                        <h4>WiFi</h4>
                                        <p>Internet Connectivity</p>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars10" name="wifi">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-floating col-md-12 mt-5 d-none" id="form-value">
                                        <h4>Value for money</h4>
                                        <div class="star-rating2 mt-2">
                                            <select class="star" id="stars11" name="value">
                                                <option class="star1" value="20">1</option>
                                                <option class="star2" value="40">2</option>
                                                <option class="star3" value="60">3</option>
                                                <option class="star4" value="80">4</option>
                                                <option class="star5" value="100">5</option>  
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <h2 class="mt-5 text-center">Optional Personal Information</h2>
                                    <div class="row mt-5">
                                        <div class="form-room_number col-md-12">
                                            <label class="form-label">Your Room Number?</label>
                                            <input type="text" name="room_number" class="room_number form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="form-type col-md-12">
                                            <label class="form-label">What type of trip was this?</label>
                                            <input type="text" name="type" class="type form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="form-country col-md-12">
                                            <label class="form-label">Country of origin</label>
                                            <input type="text" name="country" class="country form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <hr>
                                    <h2 class="mt-5 text-center">Submit your review</h2>
                                    <div class="col-md-12">
                                        <div class="row mt-5">
                                            <div class="form-room_number col-md-12">
                                                <label class="form-label">Name</label>
                                                <input type="text" name="username" class="room_number form-control" required>
                                                <span class="bs-stepper-subtitle" style="color: #b9b9c3">Your name will be shown alongside your review.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="form-room_number col-md-12">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="room_number form-control" required>
                                                <span class="bs-stepper-subtitle" style="color: #b9b9c3">Your email will never be published. It may be used by the reviewed property to contact you privately.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="button mt-3 text-center">
                                            <button type="submit" class="btn btn-primary btn-block" id="btn-simpan" value="create">Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection

@section ('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
<script src="{{ asset('Template/app-assets/js/scripts/jquery.star-rating.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/extensions/jquery.rateyo.min.js') }}"></script>
<script src="{{ asset('Template/app-assets/js/scripts/extensions/ext-component-ratings.js') }}"></script>
<script src="{{ asset('Template/app-assets/js/scripts/jquery.fontstar.js') }}"></script>
<script src="{{ asset('Template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(function() {
            $('.star').barrating({
                theme: 'fontawesome-stars'
            });
        });

        // Form Arrival
        $('#cb1').on('change', function(e) {
            if($('#cb1').is(':checked')){
                // $('.form-survey').append('<div class="form-floating col-md-12" id="form-arrival"><fieldset class="form-group"><h4 class="text-center">Arrival</h4><input type="text" name="arrival" class="arrival form-control"></fieldset></div>');
                $('#form-arrival').removeClass("d-none");
            }
            else {
                if ($('#cb1').prop('checked', false)) {
                        $('#form-arrival').addClass('d-none');
                }
            }
        });

        // Form Service
        $('#cb2').on('change', function(e) {
            if($('#cb2').is(':checked')){
                $('#form-service').removeClass("d-none");
            }
            else{
                if ($('#cb2').prop('checked', false)) {
                    $('#form-service').addClass('d-none');
                }
            }
        });

        // Form Room
        $('#cb3').on('change', function(e) {
            if($('#cb3').is(':checked')){
                $('#form-room').removeClass('d-none');
            }
            else {
                if ($('#cb3').prop('checked', false)) {
                    $('#form-room').addClass('d-none');
                }
            }
        });

        // Form Food & Beverages
        $('#cb4').on('change', function(e) {
            if($('#cb4').is(':checked')){
                $('#form-fb').removeClass('d-none');
            }
            else{
                if ($('#cb4').prop('checked', false)) {
                    $('#form-fb').addClass('d-none');
                }
            }
        });

        // Form Facilities
        $('#cb5').on('change', function(e) {
            if($('#cb5').is(':checked')){
                $('#form-facilities').removeClass('d-none');
            }
            else{
                if ($('#cb5').prop('checked', false)) {
                    $('#form-facilities').addClass('d-none');
                }
            }
        });

        // Form Cleanliness
        $('#cb6').on('change', function(e) {
            if($('#cb6').is(':checked')){
                $('#form-cleanliness').removeClass('d-none');
            }
            else{
                if ($('#cb6').prop('checked', false)) {
                    $('#form-cleanliness').addClass('d-none');
                }
            }
        });

        // Form Atmosphere
        $('#cb7').on('change', function(e) {
            if($('#cb7').is(':checked')){
                $('#form-atmosphere').removeClass('d-none');
            }
            else{
                if ($('#cb7').prop('checked', false)) {
                    $('#form-atmosphere').addClass('d-none');
                }
            }
        });

        // Form Check-out
        $('#cb8').on('change', function(e) {
            if($('#cb8').is(':checked')){
                $('#form-checkout').removeClass('d-none');
            }
            else {
                if ($('#cb8').prop('checked', false)) {
                    $('#form-checkout').addClass('d-none');
                }
            }
        });

        // Form WiFi
        $('#cb9').on('change', function(e) {
            if($('#cb9').is(':checked')){
                $('#form-wifi').removeClass('d-none');
            }
            else {
                if ($('#cb9').prop('checked', false)) {
                    $('#form-wifi').addClass('d-none');
                }
            }
        });

        // Form Value
        $('#cb10').on('change', function(e) {
            if($('#cb10').is(':checked')){
                // $('.form-survey').append('<div class="form-floating col-md-12" id="form-value"><fieldset class="form-group"><h4 class="text-center">Value for Money</h4><input type="text" name="value" class="value form-control"></fieldset></div>');
                $('#form-value').removeClass('d-none');
            }
            else{
                if ($('#cb10').prop('checked', false)) {
                    // $('#form-value:last').remove();
                    $('#form-value').addClass('d-none');
                }
            }
        });

        $('#stars').on('change', function(){
            var starRating = $('.star').val('Adequate', 'Inadequate');
            var msg = "";

            if ($('.star').val(starRating)) {
                msg = "Thanks! You FUCK";
            };

            responseMessage(msg);
            
        });

        function responseMessage(msg) {
            $('.success-box').fadeIn(200);  
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }

        $('#stars2').on('change', function(){
            var starRating = $('.star').val('Adequate', 'Inadequate');
            var msg = "";

            if ($('.star').val(starRating)) {
                msg = "Thank you";
            };

            responseMessage(msg);
            
        });

        function responseMessage(msg) {
            $('.success-box').fadeIn(200);  
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }

        //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
        //jika id = formSurvey panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
        //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
        if ($("#formSurvey").length > 0) {
            $("#formSurvey").validate({
                submitHandler: function(form) {
                    var actionType = $('#btn-simpan').val();
                    // Mengubah data menjadi objek agar file image bisa diinput kedalam database
                    var formData = new FormData($('#formSurvey')[0]);
                    $.ajax({
                        data: formData, //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
                        url: "/survey/store", //url simpan data
                        type: "POST", //data tipe kita kirim berupa JSON
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response.status);
                            if (response.status == 400) {
                                $('#errorlist').html("");
                                $('#errorlist').addClass('class="alert alert-danger mb-3 alert-validation-msg" role="alert"');
                                $.each(response.errors, function(key, err_value) {
                                    $('#errorlist').append('<div class="alert-body d-flex align-items-center"><i data-feather="info" class="me-50"></i><span>' + err_value +
                                        '</span></div>');
                                });

                                $('#btn-simpan').text('Submiting...');
                            
                            // console.log(response.status);
                            } else if (response.status == 200) {
                                setTimeout(function(){ // wait for 5 secs(2)
                                    location.reload(); // then reload the page.(3)
                                }, 5000);
                                $('#formSurvey').find('input').val('');
                                toastr.success(response.message + response.timestamp);
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

    });
</script>
@endsection