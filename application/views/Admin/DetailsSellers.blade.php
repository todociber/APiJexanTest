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
                        @include('Alerts.Flash')
                        <table class="table table-responsive" border="0" id="details">

                            <tbody>
                            <tr>
                                <td>Name:  </td>
                                <td><b>{{$seller->user->name}}</b></td>
                            </tr>
                            <tr>
                                <td>Last Name:  </td>
                                <td><b>{{$seller->user->lastname}}</b></td>
                            </tr>
                            <tr>
                                <td>Email:  </td>
                                <td><b>{{$seller->user->email}}</b></td>
                            </tr>
                            <tr>
                                <td>Ebay User:  </td>
                                <td><b>{{$seller->username}}</b></td>
                            </tr>
                            <tr>
                                <td>Ebay Registration date:  </td>
                                <td><b>{{$seller->RegistrationDate}}</b></td>
                            </tr>
                            <tr>
                                <td>Seller Business Type:   </td>
                                <td><b>{{$seller->SellerBusiness_Type}}</b></td>
                            </tr>
                            <tr>
                                <td>Feedback Ebay:   </td>
                                <td><b>{{$seller->PositiveFeedbackPercent}}%</b></td>
                            </tr>
                            <tr>
                                <td><a class="btn btn-warning" href="{{base_url()}}sellers">
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