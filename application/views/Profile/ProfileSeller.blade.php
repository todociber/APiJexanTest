@extends('Layout.LayoutSeller')

@section('title')
    <title>Profile</title>

@stop
@section('NombrePantalla')
    Profile
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Profile</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">
            <div role="form">
                <div class="row">
                    <div class="col-md-12">
                        @include('Alerts.Flash')
                        <table class="table table-responsive" border="0" id="details">

                            <tbody>
                            <tr>
                                <td>Name:  </td>
                                <td><b>{{$user->name}}</b></td>
                            </tr>
                            <tr>
                                <td>Last Name:  </td>
                                <td><b>{{$user->lastname}}</b></td>
                            </tr>
                            <tr>
                                <td>Email:  </td>
                                <td><b>{{$user->email}}</b></td>
                            </tr>
                            <tr>
                                <td>Registration date:  </td>
                                <td><b>{{$user->created_at}}</b></td>
                            </tr>
                            <tr>
                                <td>Username Ebay:  </td>
                                <td><b>{{$user->profilesEbays[0]->username}}</b></td>
                            </tr>
                            <tr>
                                <td>Seller Business Type:   </td>
                                <td><b>Seller</b></td>
                            </tr>
                            <tr>
                                <td><a class="btn btn-warning" href="{{base_url()}}myItems">
                                        return
                                    </a> </td>
                                <td></td>
                            </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
        </div><!--row-->


        <!-- /.box -->
    </div>
    </div>


@stop