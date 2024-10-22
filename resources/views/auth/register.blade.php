@extends('master.auth.app')
@section('content')

    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2 align-items-center">
                            <img src="{{ asset('Template/master/img/logodamri.png') }}" alt="" srcset="" style="width: 60%">
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Adventure starts here 🚀</h4>
                        <p class="mb-4">Make your app management easy and fun!</p>
        
                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">{{ __('Name') }}</label>
                                <input
                                type="text"
                                class="form-control  @error('name') is-invalid @enderror"
                                id="username"
                                name="name"
                                placeholder="Enter your name"
                                required autocomplete="name"
                                autofocus
                                value="{{ old('name') }}"
                                />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                    required autocomplete="new-password"
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">{{ __('Confirm Password') }}</label>
                                <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password-confirm"
                                    class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                    required autocomplete="new-password"
                                />
                                </div>
                            </div>
            
                            <div class="mb-3">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
                        </form>
        
                        <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="auth-login-basic.html">
                            <span>Sign in instead</span>
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
            <!-- Register Card -->
            </div>
        </div>
    </div>
  
    <!-- / Content -->
@endsection
