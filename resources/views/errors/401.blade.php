@extends('layouts.app')
@section('content')
<!-- Content -->
    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
          <h2 class="mb-1 mt-4">You're not authorized!</h2>
          <p class="mb-4 mx-2">You do not have permission to view this page using the credentials that you have provided while login.
            Please contact your site administrator.</p>
          <a href="/dashboard" class="btn btn-primary mb-4">Back to home</a>
          <div class="mt-4">
            <img
              src="{{ asset('Template/master/img/illustrations/page-misc-you-are-not-authorized.png') }}"
              alt="page-misc-error"
              width="225"
              class="img-fluid"
            />
          </div>
        </div>
      </div>
      <div class="container-fluid misc-bg-wrapper">
        <img
          src="{{ asset('Template/master/img/illustrations/page-misc-you-are-not-authorized.png') }}"
          alt="page-misc-error"
          data-app-light-img="illustrations/bg-shape-image-light.png"
          data-app-dark-img="illustrations/bg-shape-image-dark.png"
        />
      </div>
      <!-- /Error -->
      <!-- / Content -->
@endsection