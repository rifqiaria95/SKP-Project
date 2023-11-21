@extends('layouts.app')
@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 p-4">
                        <img class="card-img-top" src="{{ asset('Template/app-assets/images/profile/user-uploads/timeline.jpg') }}" alt="User Profile Image">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-12 p-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">Thank you for taking the time to review your stay at our hotel! Your personal feedback will help us improve and will allow future guests to get to know us better. We sincerely appreciate your time. Please note that our evaluation system uses a scoring scale from 1 (inadequate) to 5 (excellent).</p>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Your overall experience score : *</label>
                                        <input type="text" name="nama_depan" class="nama_depan form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Brief description about your experience with us</label>
                                        <textarea type="textarea" name="nama_belakang" class="nama_belakang form-control">
                                        </textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Your suggestion for us to improve our service :</label>
                                        <textarea type="text" name="tempat_lahir" class="tempat_lahir form-control">
                                        </textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">How likely are you to recommend us to your friends or colleagues?</label>
                                        <input type="text" name="tanggal_lahir" class="tanggal_lahir form-control" required>
                                    </div>
                                    <hr>
                                    <h2 class="mt-5 text-center">Your Experience</h2>
                                    <div class="form-floating col-md-6">
                                        <fieldset class="form-group">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select class="select2 form-select" name="jenis_kelamin" id="selectJK" required>
                                                <option>Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="email form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Avatar</label>
                                        <input type="file" name="avatar" class="form-control">
                                    </div>
                                </div>
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
<script src="{{ asset('Template/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>\
<script>
    $(document).ready(function(){
  
    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
    
        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
        if (e < onStar) {
            $(this).addClass('hover');
        }
        else {
            $(this).removeClass('hover');
        }
        });
        
    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
        $(this).removeClass('hover');
        });
    });
    
    
    /* 2. Action to perform on click */
    $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
        }
        
        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var msg = "";
        if (ratingValue > 1) {
            msg = "Thanks! You rated this " + ratingValue + " stars.";
        }
        else {
            msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
        }
        responseMessage(msg);
        
    });
    
    
    });


    function responseMessage(msg) {
    $('.success-box').fadeIn(200);  
    $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }
</script>
@endsection