<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Star Admin2 </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    @yield('css')
</head>

<body class="with-welcome-text">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="../index.html">
                        <img src="../assets/images/logo.svg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="../index.html">
                        <img src="../assets/images/logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="../assets/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">Allen Moreno</p>
                                <p class="fw-light text-muted mb-0">allenmoreno@gmail.com</p>
                            </div>
                            <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                Profile <span class="badge badge-pill badge-danger">1</span></a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a> -->
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @if (Auth::user()->role == 2)
                <ul class="nav">
                    <li class="nav-item {{ (request()->is('sales')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sales') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Sales Order</span>
                        </a>
                    </li>
                </ul>
                @elseif (Auth::user()->role == 3)
                <ul class="nav">
                    <li class="nav-item {{ (request()->is('purchase')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('purchase') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Purchase</span>
                        </a>
                    </li>
                </ul>
                @elseif (Auth::user()->role == 4)

                <ul class="nav">
                    <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Inventory</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('penerimaan')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penerimaan') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Penerimaan</span>
                        </a>
                    </li>
                </ul>
                @else
                <ul class="nav">
                    <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home')}}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Inventory</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('sales')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sales') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Sales Order</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('purchase')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('purchase') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Purchase</span>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('penerimaan')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penerimaan') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Penerimaan</span>
                        </a>
                    </li>
                </ul>
                @endif
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                    @endif

                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/proBanner.js"></script>
    <!-- <script src="../../assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->

    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    @yield('script')
</body>

</html>