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
                        {!! form_open('items/update/'.$id,array('class' => 'form-vertical','style'=>'margin-top: 5px','role' => 'form')) !!}<button type="submit" class="btn btn-bitbucket">Update List Items</button>{!! form_close() !!}

                            <div style="width: 100%; padding-top: 10px ;padding-left: 10px; border: 0px;">

                                @include('Alerts.Flash')
                                <div class="table-responsive">

                                    <table id="example3" class="table table-hover dt-responsive display nowrap"
                                           cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th><p class="text-center">Item Id</p></th>
                                            <th><p class="text-center">Title</p></th>
                                            <th><p class="text-center">Url item</p></th>
                                            <th><p class="text-center">Price </p></th>
                                            <th><p class="text-center">Category </p></th>
                                            <th><p class="text-center">Actions</p></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$item->itemId}}</td>
                                                <td><b>{{$item->title}}</b></td>
                                                <td>
                                                    <a class="btn btn-twitter"  target="_blank" href="{{$item->viewItemURL}}">
                                                        Ebay's URL product
                                                    </a></td>
                                                <td>${{$item->convertedCurrentPrice}} USD</td>
                                                <td>{{$item->categoryEbay->name_ebay}}</td>
                                                <td><a class="btn btn-microsoft"  href="{{base_url()}}myItems/details/{{$item->id}}">
                                                        Details
                                                    </a></td>
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