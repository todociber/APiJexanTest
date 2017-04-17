
@if(!empty($_SESSION['success']))

    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong></strong>{{$_SESSION['success']}}
    </div>
@endif

@if(!empty($_SESSION['error']))

    <div class="alert alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong></strong>{{$_SESSION['error']}}
    </div>
@endif


@if(!empty($_SESSION['warning']))

    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong></strong>{{$_SESSION['warning']}}
    </div>
@endif



@if(!empty($_SESSION['info']))

    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong></strong>{{$_SESSION['info']}}
    </div>
@endif

@if(!empty($_SESSION['errors']))
    <?php $errors = $_SESSION['errors'];?>
    <div class="alert alert-error">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
@foreach($errors  as $error)


           <li>{{$error}}</li>


@endforeach

    </div>
@endif

