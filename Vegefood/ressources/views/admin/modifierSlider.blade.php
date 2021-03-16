@extends('layout.appadmin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row grid-margin">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Modifier un slider</h4>
                    <?php
                        $message = Session::get('message');
                        $message1 = Session::get('message1');
                    ?>
                    @if ($message)
                        <p class="alert alert-success">
                            <?php
                                echo $message;
                                Session::put('message', null);
                            ?>
                        </p>
                    @endif
                    @if ($message1)
                    <p class="alert alert-danger">
                        <?php
                            echo $message1;
                            Session::put('message1', null);
                        ?>
                    </p>
                    @endif

                    {{Form::open(['action' => 'SliderController@editSlider' ,
                    'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 
                    'multipart/form-data'])}}

                        <fieldset>
                        <div class="form-group">
                            <label for="cname">Description 1</label>
                            <input id="cname" class="form-control" name="description1" value="{{$sliders->description1}}" minlength="2" type="text" required>
                            <input id="cname" class="form-control" name="id" minlength="2" value="{{$sliders->id}}" type="hidden" required>

                        </div>
                        <div class="form-group">
                            <label for="cname">Description 2</label>
                            <input id="cname" class="form-control" name="description2" value="{{$sliders->description2}}" minlength="2" type="text" required>
                        </div>
                        <div class="form-group">
                            <label for="cname">Image</label>
                            {{Form::file('sliderImage', ['class' => 'form-control',
                            'id' => 'cname'])}}
                            {{-- <input id="cname" class="form-control" name="sliderImage" minlength="2" type="file" required> --}}
                        </div>

                        <input class="btn btn-primary" type="submit" value="Modifier">
                        </fieldset>
                    {{ Form::close() }}                    
                </div>
            </div>
        </div>
    </div>
    
@endsection