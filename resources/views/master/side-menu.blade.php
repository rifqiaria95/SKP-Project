
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ asset('Template/app-assets/images/logo/logo.png') }}"><span class="brand-logo">
                        <img  src="{{ asset('Template/app-assets/images/logo/logo.png') }}" alt="" srcset="">
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::is('dashboard')?'active':'' }}"><a class="d-flex align-items-center" href="/dashboard"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
            @if(auth()->user()->role == 'owner')
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Forms &amp; Tables</span><i data-feather="more-horizontal"></i>
                </li>
                <li class="{{ Request::is('absensi')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/absensi"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Meal Attendance</span></a>
                <li class="{{ Request::is('survey')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/survey"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Guess Satisfaction</span></a>
                <li class="{{ Request::is('karyawan')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/karyawan"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Datatables">Karyawan SKP</span></a>
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class="{{ Request::is('user')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="/user"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Data User</span></a>
                        </li>
                    </ul>
                </li>
            @endif
            @if(auth()->user()->role == 'admin')
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Forms &amp; Tables</span><i data-feather="more-horizontal"></i>
                </li>
                <li class="{{ Request::is('absensi')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/absensi"><i data-feather="copy"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Meal Attendance</span></a>
                <li class="{{ Request::is('karyawan')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/karyawan"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Datatables">Karyawan SKP</span></a>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- END: Main Menu-->