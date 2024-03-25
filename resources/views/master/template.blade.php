<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Luwansa Hotels Group</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/libs/flatpickr/flatpickr.css') }}" />
    

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/css/pages/cards-advance.css') }}" />
    <link rel="stylesheet" href="{{ asset('Template/master/vendor/css/pages/app-invoice.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('Template/master/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    
    <script src="{{ asset('Template/master/js/config.js') }}"></script>
  </head>

  <body>
    @include('master.side-menu')
    @include('master.navbar')
    @yield('content')
    @include('master.footer')

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('Template/master/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('Template/master/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('Template/master/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('Template/master/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('Template/master/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('Template/master/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('Template/master/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('Template/master/js/skp/dashboard.js') }}"></script>
    <script src="{{ asset('Template/master/js/app-invoice-add.js') }}"></script>

    {!! Toastr::message() !!}

    @yield('script')
{{-- 
    <script>
      var dt = new Date();
      document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"/"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (dt.getFullYear()) +" "+ (("0"+dt.getHours()).slice(-2)) +":"+ (("0"+dt.getMinutes()).slice(-2));
        
    </script> --}}
  </body>
</html>
