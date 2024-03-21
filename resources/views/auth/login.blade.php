@extends('master.auth.app')
@section('content')
  
  <!-- Content -->

  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img
            src="{{ asset('Template/master/img/illustrations/auth-login-illustration-light.png') }}"
            alt="auth-login-cover"
            class="img-fluid my-5 auth-illustration"
            data-app-light-img="illustrations/auth-login-illustration-light.png"
            data-app-dark-img="illustrations/auth-login-illustration-dark.png"
          />

          <img
            src="{{ asset('Template/master/img/illustrations/bg-shape-image-light.png') }}"
            alt="auth-login-cover"
            class="platform-bg"
            data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png"
          />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <img src="{{ asset('Template/master/img/logo3.png') }}" alt="" srcset="" style="width: 60%">
          <!-- /Logo -->
          <h4 class="mt-4 fw-bold">Login to PT Santini Kelola Persada</h4>
          <p class="mb-4">Please sign-in to your account and start the adventure</p>
          @if (session('error'))
            <div class="alert alert-danger">
                    {{ session('error') }}
            </div>
          @endif
          <form method="POST" action="{{ route('login') }}" id="formAuthentication" class="mb-3">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">{{ __('Email Address') }}</label>
              <input
                type="text"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}"
                id="email"
                name="email"
                placeholder="Enter your email"
                autofocus
              />
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                <a href="auth-forgot-password-cover.html">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge">
                <input
                  id="pass_log_id"
                  type="password"
                  id="password"
                  class="form-control @error('password') is-invalid @enderror"
                  type="password"
                  name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password"
                  required
                />
                @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                <span class="input-group-text cursor-pointer">
                  <i toggle="#password-field" class="ti ti-eye toggle-password"></i>
                </span>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember-me"> {{ __('Remember Me') }} </label>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100">{{ __('Login') }}</button>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="auth-register-cover.html">
              <span>Create an account</span>
            </a>
          </p>

          <div class="divider my-4">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
              <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
              <i class="tf-icons fa-brands fa-google fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-twitter">
              <i class="tf-icons fa-brands fa-twitter fs-5"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>

  <!-- / Content -->

@endsection

@section('script')
  <script src="{{ asset('Template/master/vendor/libs/jquery/jquery.js') }}"></script>
  <script>
    $("body").on('click', '.toggle-password', function() {
      $(this).toggleClass("ti-eye ti-eye-off");
      var input = $("#pass_log_id");
      if (input.attr("type") === "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }

    });
  </script>

@endsection