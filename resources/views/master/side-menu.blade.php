<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <!-- Menu -->

    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
      <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
          <span class="app-brand-text demo menu-text fw-bold"><img src="{{ asset('Template/master/img/logodamri.png') }}" alt="" srcset="" style="width: 3%"></span>
          
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
          <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
          <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
      </div>

      <div class="menu-inner-shadow"></div>

      <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item  {{ Request::is('dashboard')?'active':'' }}">
          <a href="/dashboard" class="menu-link">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Dashboard">Dashboard</div>
          </a>
        </li>
        <!-- SKP -->
        <li class="menu-header small text-uppercase">
          <span class="menu-header-text">Perum DAMRI</span>
        </li>
        @if(auth()->user()->role == 'owner' || auth()->user()->role == 'admin')
          {{-- <li class="menu-item {{ Request::is('karyawan')?'active':'' }}">
            <a href="/karyawan" class="menu-link">
              <i class="menu-icon tf-icons ti ti-users"></i>
              <div data-i18n="Karyawan">Karyawan</div>
            </a>
          </li> --}}
          {{-- <li class="menu-item {{ Request::is('absensi')?'active':'' }}">
            <a href="/absensi" class="menu-link">
              <i class="menu-icon tf-icons ti ti-layout-navbar"></i>
              <div data-i18n="Meal Attendance">Meal Attendance</div>
            </a>
          </li> --}}
          <li class="menu-item {{ Request::is('task')?'active':'' }}">
            <a href="/task" class="menu-link">
              <i class="menu-icon tf-icons ti ti-notes"></i>
              <div data-i18n="Task List">Task List</div>
            </a>
          </li>
        @endif
        @if(auth()->user()->role == 'karyawan' || auth()->user()->role == 'admin' || auth()->user()->role == 'owner')
          {{-- <li class="menu-item {{ Request::is('purchaseorder')?'active':'' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons ti ti-file-dollar"></i>
              <div data-i18n="Purchase Order">Purchase Order</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('purchaseorder')?'active':'' }}">
                <a href="/purchaseorder" class="menu-link">
                  <div data-i18n="List PO">List PO</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('vendor')?'active':'' }}">
                <a href="/vendor" class="menu-link">
                  <div data-i18n="List Vendor">List Vendor</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('item')?'active':'' }}">
                <a href="/item" class="menu-link">
                  <div data-i18n="List Item">List Item</div>
                </a>
              </li>
            </ul>
          </li> --}}
          <!-- Apps & Pages -->
          {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Misc</span>
          </li>
          <li class="menu-item {{ Request::is('perusahaan')?'active':'' }}">
            <a href="/perusahaan" class="menu-link">
              <i class="menu-icon tf-icons ti ti-building"></i>
              <div data-i18n="Perusahaan">Perusahaan</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('inventory')?'active':'' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
              <div data-i18n="Inventory">Inventory</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item {{ Request::is('inventory')?'active':'' }}">
                <a href="/inventory" class="menu-link">
                  <div data-i18n="Hardware">Hardware</div>
                </a>
              </li>
              <li class="menu-item {{ Request::is('vendor')?'active':'' }}">
                <a href="/vendor" class="menu-link">
                  <div data-i18n="Licenses">Licenses</div>
                </a>
              </li>
            </ul>
          </li> --}}
        @endif
        @if(auth()->user()->role == 'owner')
          <li class="menu-item {{ Request::is('user')?'active':'' }}">
            <a href="/user" class="menu-link">
              <i class="menu-icon tf-icons ti ti-users"></i>
              <div data-i18n="Users">Users</div>
            </a>
          </li>
          <li class="menu-item {{ Request::is('activitylog')?'active':'' }}">
            <a href="/activitylog" class="menu-link">
              <i class="menu-icon tf-icons ti ti-activity"></i>
              <div data-i18n="Activity Log">Activity Log</div>
            </a>
          </li>
          <!-- Settings -->
          {{-- <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Settings</span>
          </li>
          <li class="menu-item">
            <a href="/roles" class="menu-link">
              <i class="menu-icon tf-icons ti ti-settings"></i>
              <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
          </li> --}}
        @endif
      </ul>
    </aside>
    <!-- / Menu -->

    <!-- Layout container -->
    <div class="layout-page">
      

<!-- / Layout wrapper -->