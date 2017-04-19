@extends('Layout.LoginLayout')

@section('title')
    <title>Change Password</title>

@stop
@section('NombrePantalla')
    Change Password
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
                                    <div class="panel-heading">Change Password</div>
                                    <div class="panel-body">
                                        @include('Alerts.Flash')
                                        <img class="img-responsive" src="{{base_url()}}resources/assets/img/ebay_logo.jpg"
                                             alt="200" width="200" style="display:block;margin:0 auto 0 auto;">

                                        {!! form_open('login/token/change/'.$token->token,array(
                                            'class' => 'form-horizontal',
                                            'role' => 'form')) !!}

                                        <div class="form-group">
                                            <label for="password" class="col-md-4 control-label">Password</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="password" required="">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-md-4 control-label">Confirm Password</label>

                                            <div class="col-md-6">
                                                <input id="passwordConfirm" type="password" class="form-control" name="passwordConfirm" required="">

                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                             <div class="col-md-6 col-md-offset-4">
                                                 <div class="checkbox">
                                                     <label>
                                                         <input type="checkbox" name="remember"> Remember Me
                                                     </label>
                                                 </div>
                                             </div>
                                         </div>-->

                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-success">
                                                    Reset
                                                </button>


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