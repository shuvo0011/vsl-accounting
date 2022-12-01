<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VSL Account | @yield('title')</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('support_files/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('support_files/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('support_files/dist/css/adminlte.min.css') }}">



</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('support_files/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt nav-icon" style="font-size: 20px; margin-top: 2px"></i> Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('support_files/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">VSL</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('support_files/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- ...................drop down menu in slide bar..................... -->
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Charts <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/charts/chartjs.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>ChartJS</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->


                        <!-- .....................income menu...............................  -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p> BOOK KEEPING <i class="right fas fa-angle-left"></i> </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <!--  income menu  -->
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i> -->
                                        <p> INCOME </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href=" {{ route('admin.income') }} " class="nav-link">
                                                <!-- <i class="far fa-circle nav-icon"></i> -->
                                                <p> Income Entry </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href=" {{ route('admin.income.report') }} " class="nav-link">
                                                <!-- <i class="far fa-circle nav-icon"></i> -->
                                                <p> Income Report </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- ............ expense  menu -->
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i> -->
                                        <p> EXPENSE </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('admin.expense') }} " class="nav-link">
                                                <!-- <i class="far fa-circle nav-icon"></i> -->
                                                <p> Expese Entry</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('admin.expense.report') }}" class="nav-link">
                                                <!-- <i class="far fa-circle nav-icon"></i> -->
                                                <p> Expense Report </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!--      Parameter setup        -->


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p> Parameter Setup <i class="right fas fa-angle-left"></i> </p>
                            </a>

                            <ul class="nav nav-treeview">

                                <!--  cash in hand  -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.cashinhand') }}" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i> -->
                                        <p> Cash In Hand </p>
                                    </a>
                                </li>

                                <!--   gl head  -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.glhead') }}" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i> -->
                                        <p> GL Head </p>
                                    </a>
                                </li>


                                <!--  officer  -->
                                <li class="nav-item">
                                    <a href="{{ route('admin.officer') }}" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i> -->
                                        <p> Officer </p>
                                    </a>
                                </li>

                                <!--   Clients Name  -->
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i> -->
                                        <p> Clients Name </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.salary') }}" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p> Salary  </p>
                            </a>

                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('page-content')




        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="#">Venture Solutions Ltd</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('support_files/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('support_files/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('support_files/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('support_files/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('support_files/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('support_files/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('support_files/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('support_files/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('support_files/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{ asset('support_files/dist/js/pages/dashboard2.js') }}"></script> -->


    @yield('script.js')

</body>

</html>