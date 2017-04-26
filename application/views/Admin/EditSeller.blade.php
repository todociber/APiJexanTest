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
                            @include('Alerts.Flash')
                            {!! form_open('sellers/edit/save/'.$id,array(
                                'class' => 'form-horizontal',
                                'role' => 'form',
                                "id"=>"sellerForm")) !!}

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{!! @$_SESSION['name'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Last Name</label>
                                <div class="col-md-6">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="{!! @$_SESSION['lastname'] !!}" required="true" autofocus="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Phone number</label>
                                <div class="col-md-6">
                                    <input id="phoneNumber" type="text" onchange="validator()"  class="form-control" name="phoneNumber"   required="true" autofocus="">
                                    <input id="countryName" type="text" onchange=""  class="form-control" name="countryName" style="display: none" value="" required="true" autofocus="">
                                    <input id="countryExtension" type="text" onchange=""  class="form-control" name="countryExtension" style="display: none" value="" required="true" autofocus="">
                                    <label id="validation" title="test"></label>
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
                                <label for="email" class="col-md-4 control-label">Country</label>
                                <div class="col-md-6">
                                    <select name="country" id="country" onload="GetRegionsLoad(this.value)" onselect="GetRegionsLoad(this.value)" onchange="GetRegionsLoad(this.value)" class="js-example-basic-single" style="width: 100%">
                                        <?php $count=0;?>
                                        @foreach($countries as $country)
                                            @if(isset($_SESSION['countryFind'])&& $_SESSION['countryFind']==$country->id)
                                                <option value="{{$country->id}}" selected>{{$country->name}}</option>
                                            @elseif($count==0)
                                                <?php $count=1;?>
                                                <option value="" selected>-- Select your country --</option>
                                            @else
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="divRegion" class="form-group add-Innactive" >
                                <label class="col-md-4 control-label">Regions </label>
                                <div class="col-md-6">
                                    <select name="regions" id="regions" onvolumechange="GetCityCountry(this.value)" onchange="GetCityCountry(this.value)"  class="js-example-basic-single" style="width: 100%">

                                    </select>
                                </div>
                            </div>
                            <div id="divCity" class="form-group add-Innactive" >
                                <label class="col-md-4 control-label">Cities </label>
                                <div class="col-md-6">
                                    <select name="cities" id="cities" class="js-example-basic-single" style="width: 100%">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Zip Code</label>
                                <div id ="divmunzipcodes" class="col-md-6">
                                    <input id="zipcode" type="text" class="form-control" name="zipcode" value="{!! @$_SESSION['zipcode'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Address Line 1</label>
                                <div class="col-md-6">
                                    <input id="addressLine1" type="text" class="form-control" name="addressLine1" value="{!! @$_SESSION['addressLine1'] !!}" required="true" autofocus="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Address Line 2<h6>(optional)</h6></label>
                                <div class="col-md-6">
                                    <input id="addressLine2" type="text" class="form-control" name="addressLine2" value="{!! @$_SESSION['addressLine2'] !!}"  autofocus="">
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-6">
                                    <button type="submit" id="save" disabled="true" class="btn btn-success">
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