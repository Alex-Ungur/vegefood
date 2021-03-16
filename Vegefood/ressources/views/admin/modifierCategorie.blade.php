@extends('layout.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Modifier une catégorie</h4>
                    <?php
                        $message = Session::get('message');
                    ?>
                    @if ($message)
                        <p class="alert alert-success">
                            <?php
                                echo $message;
                                Session::put('message', null);
                            ?>
                        </p>
                    @endif

                    {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
                    {{Form::open(['action' => 'CategoryController@editCategorie' ,
                    'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 
                    'multipart/form-data'])}}
                        <fieldset>
                        <div class="form-group">
                            <label for="cname">Catégorie</label>
                            <input id="cname" class="form-control" name="name" minlength="2" type="text" value="{{$categories->name}}" required>
                            <input id="cname" class="form-control" name="id" minlength="2" type="hidden" value="{{$categories->id}}" required>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Modifier">
                        </fieldset>
                    {{-- </form> --}}
                    {{ Form::close() }}
                    </div>
                </div>
        </div>
    </div>
    
@endsection