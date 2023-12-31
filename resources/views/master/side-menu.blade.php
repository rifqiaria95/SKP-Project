
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="/dashboard"><span class="brand-logo">
                <img src="{{ asset('Template/app-assets/images/logo/logo3.png') }}" alt="" srcset=""></span>
                <h2 class="brand-text d-none"></h2>
                </a>
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i id="closeButton" class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::is('dashboard')?'active':'' }}"><a class="d-flex align-items-center" href="/dashboard"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a>
            @if(auth()->user()->role == 'owner')
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Forms &amp; Tables</span><i data-feather="more-horizontal"></i>
                </li>
                <li class="{{ Request::is('absensi')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='grid'></i><span class="menu-title text-truncate" data-i18n="User">Meal Attendance</span></a>
                    <ul class="menu-content">
                        <li class="nav-item"><a class="d-flex align-items-center" href="/absensi"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Form Elements">SKP</span></a>
                        </li>
                        <li class="nav-item"><a class="d-flex align-items-center" href="/absensi/lumire"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Lumire</span></a>
                        </li>
                        <li class="nav-item"><a class="d-flex align-items-center" href="/absensi/jsluwansa"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Form Elements">JS Luwansa</span></a>
                        </li>
                        <li class="nav-item"><a class="d-flex align-items-center" href="/absensi/luwansamanado"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Luwansa Manado</span></a>
                        </li>
                        <li class="nav-item"><a class="d-flex align-items-center" href="/absensi/palangkaraya"><i data-feather="circle"></i><span class="menu-title text-truncate" data-i18n="Form Elements">Luwansa Palangka Raya</span></a>
                        </li>
                    </ul>
                </li>
                <li class="{{ Request::is('survey')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/survey"><i data-feather='grid'></i><span class="menu-title text-truncate" data-i18n="Form Elements">Guess Satisfaction</span></a>
                <li class="{{ Request::is('karyawan')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="/karyawan"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Datatables">Karyawan SKP</span></a>
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class="{{ Request::is('user')?'active':'' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="/user"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Data User</span></a>
                        </li>
                    </ul>
                </li>
                <li><a class="d-flex align-items-center" href="/activitylog"><i data-feather='activity'></i><span class="menu-item text-truncate" data-i18n="List">Activity Log</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Settings</span><i data-feather="more-horizontal"></i>
                <li><a class="d-flex align-items-center" href="/rolemanagement"><i data-feather='settings'></i><span class="menu-item text-truncate" data-i18n="Settings">Role & Permission</span></a>
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