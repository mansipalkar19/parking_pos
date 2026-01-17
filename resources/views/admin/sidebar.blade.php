<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.html" class="logo">
        <img
          src="{{ asset('admin/assets/img/kaiadmin/logo_light.svg') }}"
          alt="navbar brand"
          class="navbar-brand"
          height="20" />
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item active">
          <a
            data-bs-toggle="collapse"
            href="#dashboard"
            class="collapsed"
            aria-expanded="false">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Masters</h4>
        </li>

        <!-- User Roles -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#userRolesMenu">
            <i class="fas fa-layer-group"></i>
            <p>User Roles</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="userRolesMenu">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('userroles') }}">
                  <span class="sub-item">Add User Roles</span>
                </a>
              </li>
              <li>
                <a href="{{ route('vendorlist') }}">
                  <span class="sub-item">Approve User</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Places -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#placesMenu">
            <i class="fas fa-th-list"></i>
            <p>Places</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="placesMenu">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('placenames') }}">
                  <span class="sub-item">Add Place Name</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Vehicle Type -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#vehicleTypeMenu">
            <i class="fas fa-th-list"></i>
            <p>Vehicle Type</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="vehicleTypeMenu">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('vehicletype') }}">
                  <span class="sub-item">Add Vehicle Type Name</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <!-- Parking Rates -->
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#parkingRatesMenu">
            <i class="fas fa-th-list"></i>
            <p>Parking Rates</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="parkingRatesMenu">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{ route('parkingrates') }}">
                  <span class="sub-item">Add Parking Rates</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->