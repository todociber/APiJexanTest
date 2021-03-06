@extends('Layout.LayoutAdmin')

@section('title')
    <title>Restore Sellers</title>

@stop
@section('NombrePantalla')
    Restore Sellers
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Restore Sellers</h3>
        </div><!-- /.box-header -->
        <!-- form start -->

        <div class="box-body">


            <div role="form">

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <a class="btn btn-warning "href="{{base_url()}}sellers">
                                Return
                            </a></br>
                            <div style="width: 100%; padding-top: 10px ;padding-left: 10px; border: 0px;">
                                @include('Alerts.Flash')
                                <div class="table-responsive">
                                    <table id="example4" class="table table-hover dt-responsive display nowrap"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th><p class="text-center">Name</p></th>
                                            <th><p class="text-center">Email</p></th>
                                            <th><p class="text-center">Ebay's User</p></th>
                                            <th><p class="text-center">Registration date</p></th>
                                            <th><p class="text-center">Number of Items</p></th>
                                            <th><p class="text-center">Actions</p></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sellers as $seller)
                                            <tr>
                                                <td>{{$seller->user->name}} {{$seller->user->lastname}}</td>
                                                <td>{{$seller->user->email}}</td>
                                                <td>{{$seller->username}}</td>
                                                <td>{{$seller->RegistrationDate}}</td>
                                                <td>{{count($seller->items)}}</td>
                                                <td>
                                                    {!! form_open('sellers/restore/'.$seller->id,array(
                                                    'class' => 'form-horizontal',
                                                     'role' => 'form')) !!}
                                                    <button type="submit" class="btn btn-danger">
                                                        Restore Seller
                                                    </button>
                                                    {!! form_close() !!}
                                                </td>

                                            </tr>
                                        @endforeach
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