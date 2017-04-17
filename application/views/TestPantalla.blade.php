@extends('Layout.LayoutAdmin')

@section('title')
    <title>Prueba</title>

@stop
@section('NombrePantalla')
    Prueba
@stop
@section('content')










    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Ordenes pendientes de asignacion</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">


            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">


                            <br><br>

                            <div style="width: 100%; padding-left: -10px; border: 0px;">
                                <div class="table-responsive">
                                    <table id="example4" class="table table-hover dt-responsive display nowrap"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th><p class="text-center"><span class="glyphicon glyphicon-cog"></span>
                                                </p></th>
                                            <th><p class="text-center">Correlativo</p></th>
                                            <th><p class="text-center">Cliente</p></th>
                                            <th><p class="text-center">Monto</p></th>
                                            <th><p class="text-center">Fecha de vigencia</p></th>
                                            <th><p class="text-center">Tipo de Mercado</p></th>

                                            <th><p class="text-center">Estado</p></th>
                                        </tr>
                                        </thead>
                                        <tbody>



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>

        </div>
    </div>
@stop