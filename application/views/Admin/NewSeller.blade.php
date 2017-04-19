@extends('Layout.LayoutAdmin')

@section('title')
    <title>Sellers</title>

@stop
@section('NombrePantalla')
    Sellers
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Sellers</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">


            <div role="form">

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">

                            {!! form_open('login/sign_in',array(
                                'class' => 'form-horizontal',
                                'role' => 'form')) !!}

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{!! @$_SESSION['name'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Lastname</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{!! @$_SESSION['lastname'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Phone number</label>
                                <div class="col-md-6">
                                    <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" value="{!! @$_SESSION['phoneNumber'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{!! @$_SESSION['email'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">User of Ebay</label>
                                <div class="col-md-6">
                                    <input id="userEbay" type="text" class="form-control" name="userEbay" value="{!! @$_SESSION['userEbay'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Zip Code</label>
                                <div id ="divmunzipcodes" class="col-md-6">
                                    <select name="zipcodes" id="zipcodes" class="js-example-basic-single" style="width: 100%">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Address Line 1</label>
                                <div class="col-md-6">
                                    <input id="addressLine1" type="text" class="form-control" name="addressLine1" value="{!! @$_SESSION['addressLine1'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Address Line 2</label>
                                <div class="col-md-6">
                                    <input id="addressLine2" type="text" class="form-control" name="addressLine2" value="{!! @$_SESSION['addressLine2'] !!}"  autofocus="">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success">
                                        Save
                                    </button>
                                </div>
                            </div>

                            {!! form_close() !!}
                                </div>
                            </div>

                        </div>
                    </div><!--row-->


                    <!-- /.box -->
                </div>
            </div>


@stop