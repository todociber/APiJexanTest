<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
            <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/assets/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/assets/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/dist/css/select2.css">
<!-- Ionicons -->
    <link rel="stylesheet" href="{{base_url()}}resources/intl-tel-input/build/css/intlTelInput.css" />


    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/assets/plugins/datatables/dataTables.bootstrap.css">
<!-- Theme style -->

    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/assets/dist/css/AdminLTE.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/assets/dist/css/skins/_all-skins.css">



    <link rel="stylesheet" type="text/css" href="{{base_url()}}resources/assets/css/SERO.css">
    <!-- Bootstrap 3.3.5 -->


            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <![endif]-->


</head>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top nav " role="navigation">
            <!-- Logo -->

            <!-- Sidebar toggle a-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="a">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <!-- Tasks: style can be found in dropdown.less -->
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <p>

                                </p>

                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href=""
                                       class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle a -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left info">
                    <p></p>

                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">Options</li>


                <li><a href="{{base_url()}}sellers"><i class="fa fa-circle-o text-yellow"></i>
                        <span>Sellers</span></a></li>
                <li><a href="{{base_url()}}Profile"><i class="fa fa-circle-o text-green"></i>
                        <span>Profile</span></a></li>
                <li><a href="{{base_url()}}login/logout"><i class="fa fa-circle-o text-red"></i>
                        <span>Logout</span></a></li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('NombrePantalla')

            </h1>

        </section>


        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>

    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 <a href="{{base_url()}}">Jexan TestBackend</a>.</strong>
        Derechos reservados.
    </footer>


</div>

<!-- jQuery 2.1.4 -->

<script src="{{base_url()}}resources/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>


<script src="{{base_url()}}resources/dist/js/select2.full.js"></script>
<!-- Bootstrap 3.3.5 -->

<script src="{{base_url()}}resources/assets/js/bootstrap.min.js"></script>
<!-- DataTables -->

<script src="{{base_url()}}resources/assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="{{base_url()}}resources/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->

<script src="{{base_url()}}resources/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->

<script src="{{base_url()}}resources/assets/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->

<script src="{{base_url()}}resources/assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->

<script src="{{base_url()}}resources/assets/dist/js/demo.js"></script>


<script src="{{base_url()}}resources/assets/plugins/datepicker/bootstrap-datepicker.js"></script>


<script src="{{base_url()}}resources/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="{{base_url()}}resources/assets/plugins/datepicker/locales/bootstrap-datepicker.es.js"></script>

<script src="{{base_url()}}resources/assets/js/jquery.mask.min.js"></script>

<script src="{{base_url()}}resources/assets/plugins/datepicker/datepicker3.css"></script>

<script src="{{base_url()}}resources/assets/js/loading.js"></script>

<script src="{{base_url()}}resources/assets/js/SERO.js"></script>
<script src="{{base_url()}}resources/intl-tel-input/build/js/intlTelInput.min.js"></script>
@include('Layout.scripts')

</body>
</html>
