@extends('Layout.LayoutSeller')

@section('title')
    <title>Items</title>

@stop
@section('NombrePantalla')
    Items
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Items</h3>
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
                                <td colspan="2"><img class="center-block" src="{{$item->galleryURL}}" alt="{{$item->title}}"></td>

                            </tr>
                            <tr>
                                <td>Title:  </td>
                                <td><b>{{$item->title}}</b></td>
                            </tr>
                            <tr>
                                <td>Product Category:  </td>
                                <td><b>{{$item->categoryEbay->name_ebay}}</b></td>
                            </tr>
                            <tr>
                                <td>Price:  </td>
                                <td><b>$ {!! round($item->convertedCurrentPrice, 2, true) !!} USD</b></td>
                            </tr>
                            <tr>
                                <td>Selling State</td>
                                <td><b>{{$item->sellingState}}</b></td>
                            </tr>
                            <tr>
                                <td>Best Available Offer:   </td>
                                <td><b>@if($item->bestOfferStatus=='true')
                                           Yes
                                        @else
                                           Not
                                    @endif
                                    </b></td>
                            </tr>
                            <tr>
                                <td>Buy it Now:   </td>
                                <td><b>@if($item->buyItNowStatus=='true')
                                            Yes
                                        @else
                                            Not
                                        @endif</b></td>
                            </tr>
                            <tr>
                                <td>Condition: </td>
                                <td><b>{{$item->conditionsEbay->name}}</b></td>
                            </tr>
                            <tr>
                                <td>Payment method: </td>
                                <td><b>{{$item->paymentmethodsEbay->name_method}}</b></td>
                            </tr>
                            <tr>
                                <td>Product URL on Ebay: </td>
                                <td><a href="{{$item->viewItemURL}}" class="btn btn-link" target="_blank">LINK</a></td>
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