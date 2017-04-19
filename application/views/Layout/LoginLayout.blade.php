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

    <!-- DataTables -->

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
<body>


<!-- Main content -->
<section class="content">
    @yield('content')

</section>
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

    <script>
        $(function () {
                $("#example1").DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    responsive: true,
                    "order": [],

                    "language": {


                        "sProcessing": "Procesando...",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sZeroRecords": "No se encontraron resultados",
                        "sEmptyTable": "Ningún dato disponible en esta tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sSearch": "Buscar:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Ãšltimo",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }

                });
            }
        );

    </script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });


    </script>
</body>
</html>

