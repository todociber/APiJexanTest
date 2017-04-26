@extends('Layout.LoginLayout')

@section('title')
    <title>Login</title>

@stop
@section('NombrePantalla')
    Login
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
                                    <div class="panel-heading">Login</div>
                                    <div class="panel-body">
                                        @include('Alerts.Flash')
                                        <img class="img-responsive" src="{{base_url()}}resources/assets/img/ebay_logo.jpg"
                                             alt="200" width="200" style="display:block;margin:0 auto 0 auto;">

                                        <script>
                                            var xmlhttp;
                                            var xmlhttp2;
                                            if (window.XMLHttpRequest){
                                                /* código para IE7+, Firefox, Chrome,
                                                 Opera, Safari */
                                                xmlhttp=new XMLHttpRequest();
                                                xmlhttp2=new XMLHttpRequest();

                                            }else{
                                                // código para IE6, IE5
                                                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                                xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
                                            }
                                            xmlhttp.open("GET","/Items_controller/get_items",true);
                                            xmlhttp.send();
                                            xmlhttp.onreadystatechange=function(){
                                                if (xmlhttp.status==200){
                                                    console.log(xmlhttp.responseText);
                                                    for (i = 1; i <xmlhttp.responseText; i++) {
                                                        var url = "/items/getPage/"+i;
                                                        xmlhttp2=new XMLHttpRequest();
                                                        xmlhttp2.open("GET",url,true);
                                                        xmlhttp2.send();
                                                        xmlhttp2.onreadystatechange=function(){
                                                            if (xmlhttp2.status==200){
                                                                console.log(xmlhttp2.responseText);
                                                            }
                                                        }
                                                    }

                                                }
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!--row-->


                <!-- /.box -->
            </div>
        </div>
@stop