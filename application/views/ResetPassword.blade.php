@extends('Layout.LoginLayout')

@section('title')
    <title>Reset Password</title>

@stop
@section('NombrePantalla')
    Reset Password
@stop
@section('content')





    <div class="box-body">


        <div role="form">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="form-group">


                        <br><br>

                        <div style="width: 100%; padding-left: -10px; border: 0px;">
                            <div class="table-responsive">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Reset Password</div>
                                    <div class="panel-body">
                                        @include('Alerts.Flash')
                                        <img class="img-responsive" src="{{base_url()}}resources/assets/img/ebay_logo.jpg"
                                             alt="200" width="200" style="display:block;margin:0 auto 0 auto;">

                                        {!! form_open('login/generate_reset',array(
                                            'class' => 'form-horizontal',
                                            'role' => 'form')) !!}

                                        <div class="form-group">

                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                                                <label  class="col-md-12 ">Enter the email account you want to recover</label>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Reset Password
                                                </button>
                                                <a class="btn btn-link" href="{{base_url()}}login/">
                                                    Login
                                                </a>

                                            </div>
                                        </div>
                                        {!! form_close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!--row-->


                <!-- /.box -->
            </div>

@stop