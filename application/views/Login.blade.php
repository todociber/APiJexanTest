@extends('Layout.LayoutAdmin')

@section('title')
    <title>Login</title>

@stop
@section('NombrePantalla')
    Login
@stop
@section('content')

@include('Alerts.Flash')



        <div class="box-body">


            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">


                            <br><br>

                            <div style="width: 100%; padding-left: -10px; border: 0px;">
                                <div class="table-responsive">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Login</div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" role="form" method="POST" action="{{base_url()}}login/Ingresar">

                                                <div class="form-group">
                                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                                    <div class="col-md-6">
                                                        <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password" class="col-md-4 control-label">Password</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control" name="password" required="">

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" name="remember"> Remember Me
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-8 col-md-offset-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            Login
                                                        </button>

                                                        <a class="btn btn-link" href="#">
                                                            Forgot Your Password?
                                                        </a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>

@stop