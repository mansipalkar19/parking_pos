<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <link
        rel="icon"
        href="{{ asset('admin/assets/img/kaiadmin/favicon.ico') }}"
        type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Fonts and icons -->
    <script src="{{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["admin/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    @include('admin.header')
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav
                    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <nav
                            class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pe-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input
                                    type="text"
                                    placeholder="Search ..."
                                    class="form-control" />
                            </div>
                        </nav>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li
                                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-expanded="false"
                                    aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                placeholder="Search ..."
                                                class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="messageDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-envelope"></i>
                                </a>
                                <ul
                                    class="dropdown-menu messages-notif-box animated fadeIn"
                                    aria-labelledby="messageDropdown">
                                    <li>
                                        <div
                                            class="dropdown-title d-flex justify-content-between align-items-center">
                                            Messages
                                            <a href="#" class="small">Mark all as read</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="{{ asset('admin/assets/img/jm_denis.jpg') }}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jimmy Denis</span>
                                                        <span class="block"> How are you ? </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="{{ asset('admin/assets/img/chadengle.jpg') }}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Chad</span>
                                                        <span class="block"> Ok, Thanks ! </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="{{ asset('admin/assets/img/mlane.jpg') }}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Jhon Doe</span>
                                                        <span class="block">
                                                            Ready for the meeting today...
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="{{ asset('admin/assets/img/talha.jpg') }}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="subject">Talha</span>
                                                        <span class="block"> Hi, Apa Kabar ? </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="notifDropdown"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification">4</span>
                                </a>
                                <ul
                                    class="dropdown-menu notif-box animated fadeIn"
                                    aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            You have 4 new notification
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center">
                                                <a href="#">
                                                    <div class="notif-icon notif-primary">
                                                        <i class="fa fa-user-plus"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> New user registered </span>
                                                        <span class="time">5 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-success">
                                                        <i class="fa fa-comment"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Rahmad commented on Admin
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-img">
                                                        <img
                                                            src="{{ asset('admin/assets/img/profile2.jpg') }}"
                                                            alt="Img Profile" />
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block">
                                                            Reza send messages to you
                                                        </span>
                                                        <span class="time">12 minutes ago</span>
                                                    </div>
                                                </a>
                                                <a href="#">
                                                    <div class="notif-icon notif-danger">
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="notif-content">
                                                        <span class="block"> Farrah liked Admin </span>
                                                        <span class="time">17 minutes ago</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-icon dropdown hidden-caret">
                                <a
                                    class="nav-link"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <i class="fas fa-layer-group"></i>
                                </a>
                                <div class="dropdown-menu quick-actions animated fadeIn">
                                    <div class="quick-actions-header">
                                        <span class="title mb-1">Quick Actions</span>
                                        <span class="subtitle op-7">Shortcuts</span>
                                    </div>
                                    <div class="quick-actions-scroll scrollbar-outer">
                                        <div class="quick-actions-items">
                                            <div class="row m-0">
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-danger rounded-circle">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </div>
                                                        <span class="text">Calendar</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-warning rounded-circle">
                                                            <i class="fas fa-map"></i>
                                                        </div>
                                                        <span class="text">Maps</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div class="avatar-item bg-info rounded-circle">
                                                            <i class="fas fa-file-excel"></i>
                                                        </div>
                                                        <span class="text">Reports</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-success rounded-circle">
                                                            <i class="fas fa-envelope"></i>
                                                        </div>
                                                        <span class="text">Emails</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-primary rounded-circle">
                                                            <i class="fas fa-file-invoice-dollar"></i>
                                                        </div>
                                                        <span class="text">Invoice</span>
                                                    </div>
                                                </a>
                                                <a class="col-6 col-md-4 p-0" href="#">
                                                    <div class="quick-actions-item">
                                                        <div
                                                            class="avatar-item bg-secondary rounded-circle">
                                                            <i class="fas fa-credit-card"></i>
                                                        </div>
                                                        <span class="text">Payments</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a
                                    class="dropdown-toggle profile-pic"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img
                                            src="{{ asset('admin/assets/img/profile.jpg') }}"
                                            alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Hizrian</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img
                                                        src="{{ asset('admin/assets/img/profile.jpg') }}"
                                                        alt="image profile"
                                                        class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>Hizrian</h4>
                                                    <p class="text-muted">hello@example.com</p>
                                                    <a
                                                        href="profile.html"
                                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">My Profile</a>
                                            <a class="dropdown-item" href="#">My Balance</a>
                                            <a class="dropdown-item" href="#">Inbox</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Places</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Add Place Name</a>
                            </li>

                        </ul>
                    </div>

                    <div class="row g-4">

                        <!-- ADD ROLE FORM -->
                        <div class="col-lg-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header">
                                    <h5 class="mb-0">Add Place</h5>
                                </div>

                                <form method="POST" action="{{ route('placename.store') }}">
                                    @csrf

                                    <div class="card-body">
                                        <input type="hidden" name="user_id" value="{{ auth()->id() ?? 1 }}">
                                        <input type="hidden" name="operator_id" value="{{ auth()->id() ?? 1 }}">
                                        <input type="hidden" name="status" value="1">
                                        <!-- Place Name -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Place Name</label>
                                            <input
                                                type="text"
                                                name="place_name"
                                                class="form-control no-focus"
                                                placeholder="Enter place name"
                                                required
                                                maxlength="100" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Address</label>
                                            <textarea
                                                name="address"
                                                class="form-control"
                                                rows="3"
                                                placeholder="Enter full address"
                                                required></textarea>
                                        </div>

                                        <!-- No of Slots -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">No of Slots</label>
                                            <input
                                                type="number"
                                                name="no_of_slots"
                                                class="form-control"
                                                placeholder="Enter number of slots"
                                                required
                                                min="1">
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Vehicle Type</label>

                                            @foreach($vehicleTypes as $type)
                                            <div class="form-check">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="vehicle_type[]"
                                                    value="{{ $type->id }}"
                                                    id="vehicle_{{ $type->id }}">
                                                <label class="form-check-label" for="vehicle_{{ $type->id }}">
                                                    {{ $type->vehicle_type_name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>



                                        <!-- Buttons -->
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fa fa-save me-1"></i> Save
                                            </button>
                                            <button type="reset" class="btn btn-outline-secondary px-4">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <!-- ROLES TABLE -->
                        <div class="col-lg-8">
                            <div class="card shadow-sm h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">User Roles List</h5>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="rolesTable" class="table table-striped table-hover align-middle w-100">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Place Name</th>
                                                    <th>Address</th>
                                                    <th>No of Slots</th>
                                                    <th>Created</th>
                                                    <th>Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>


                                <div class="modal fade" id="editRoleModal" tabindex="-1">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Place</h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form id="editPlaceForm">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" id="edit_place_id">

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Place Name</label>
                                                        <input type="text" id="edit_place_name" class="form-control" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Address</label>
                                                        <textarea id="edit_address" class="form-control" rows="3" required></textarea>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">No of Slots</label>
                                                        <input type="number" id="edit_no_of_slots" class="form-control" min="1" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label fw-semibold">Vehicle Type</label>

                                                        @foreach($vehicleTypes as $type)
                                                        <div class="form-check">
                                                            <input class="form-check-input edit-vehicle"
                                                                type="checkbox"
                                                                value="{{ $type->id }}"
                                                                id="edit_vehicle_{{ $type->id }}">
                                                            <label class="form-check-label">
                                                                {{ $type->vehicle_type_name }}
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-success">Update</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="deleteRoleModal" tabindex="-1">
                                    <div class="modal-dialog modal-sm modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger">Confirm Delete</h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body text-center">
                                                <input type="hidden" id="delete_role_id">
                                                <p class="mb-0">Are you sure you want to delete this role?</p>
                                            </div>

                                            <div class="modal-footer justify-content-center">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                <button class="btn btn-danger" id="confirmDeletePlace">Yes, Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                    @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div>
                    <div>
                        Distributed by
                        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div>
                </div>
            </footer>
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="selected changeLogoHeaderColor"
                                data-color="dark"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="blue"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="purple"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="light-blue"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="green"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="orange"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="red"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="white"></button>
                            <br />
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="dark2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="blue2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="purple2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="light-blue2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="green2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="orange2"></button>
                            <button
                                type="button"
                                class="changeLogoHeaderColor"
                                data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="dark"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="blue"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="purple"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="light-blue"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="green"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="orange"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="red"></button>
                            <button
                                type="button"
                                class="selected changeTopBarColor"
                                data-color="white"></button>
                            <br />
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="dark2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="blue2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="purple2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="light-blue2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="green2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="orange2"></button>
                            <button
                                type="button"
                                class="changeTopBarColor"
                                data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button
                                type="button"
                                class="changeSideBarColor"
                                data-color="white"></button>
                            <button
                                type="button"
                                class="selected changeSideBarColor"
                                data-color="dark"></button>
                            <button
                                type="button"
                                class="changeSideBarColor"
                                data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        });
    </script>

    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('admin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- jQuery MUST be first -->
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('admin/assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('admin/assets/js/demo.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#rolesTable').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                pageLength: 25,
                lengthMenu: [10, 25, 50, 100],
                ajax: {
                    url: "{{ url('/api/places/datatable') }}",
                    type: "GET"
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'place_name',
                        name: 'place_name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'vehicle_types',
                        name: 'vehicle_types',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                <button class="btn btn-sm btn-primary editBtn" data-id="${data.id}">
                    <i class="fa fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger deleteBtn" data-id="${data.id}">
                    <i class="fa fa-trash"></i>
                </button>
            `;
                        }
                    }
                ]

            });

        });



        // Open Edit Modal
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');

            $.get("{{ url('/api/places-list') }}/" + id, function(res) {

                let data = res.data;

                $('#edit_place_id').val(data.id);
                $('#edit_place_name').val(data.place_name);
                $('#edit_address').val(data.address);
                $('#edit_no_of_slots').val(data.no_of_slots);

                // Reset all vehicle checkboxes
                $('.edit-vehicle').prop('checked', false);

                // vehicle_type is already an array
                let vehicles = data.vehicle_type;

                vehicles.forEach(function(vId) {
                    $('#edit_vehicle_' + vId).prop('checked', true);
                });

                $('#editRoleModal').modal('show');
            });
        });

        // Update Role
        $('#editPlaceForm').submit(function(e) {
            e.preventDefault();

            let id = $('#edit_place_id').val();

            let vehicleTypes = [];
            $('.edit-vehicle:checked').each(function() {
                vehicleTypes.push($(this).val());
            });

            $.ajax({
                url: "{{ route('placename.update', ':id') }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    place_name: $('#edit_place_name').val(),
                    address: $('#edit_address').val(),
                    no_of_slots: $('#edit_no_of_slots').val(),
                    vehicle_type: vehicleTypes,
                    operator_id: "{{ auth()->id() ?? 1 }}", // REQUIRED
                    status: 1
                },
                success: function() {
                    $('#editRoleModal').modal('hide');
                    $('#rolesTable').DataTable().ajax.reload(null, false);
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'Update failed');
                }
            });
        });

        // Open Delete Modal
        $(document).on('click', '.deleteBtn', function() {
            $('#delete_role_id').val($(this).data('id'));
            $('#deleteRoleModal').modal('show');
        });

        // Confirm Delete
        $('#confirmDeletePlace').click(function() {
            let id = $('#delete_role_id').val();

            $.ajax({
                url: "{{ route('placename.delete', ':id') }}".replace(':id', id),
                type: 'POST',
                success: function() {
                    $('#deleteRoleModal').modal('hide');
                    $('#rolesTable').DataTable().ajax.reload(null, false);
                },
                error: function() {
                    alert('Delete failed');
                }
            });
        });
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });

        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";

                setTimeout(() => alert.remove(), 500); // Remove after fade out
            }
        }, 3000); // 3 seconds
    </script>
</body>

</html>