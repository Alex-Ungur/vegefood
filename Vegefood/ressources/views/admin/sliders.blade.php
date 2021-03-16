@extends('layout.appadmin')

@section('content')
<?php 

$sliders = DB::table('sliders')
//          ->where('status', 1)
          ->get();
$increment = 1;

?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Sliders</h4>
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
              
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Image</th>
                            <th>Description 1</th>
                            <th>Description 2</th>
                            <th>Catégorie</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($sliders as $slider)
                        <tr>
                            <td>{{$increment}}</td>
                            <td><img src="storage/slider_images/{{$slider->sliderImage}}" alt=""></td>
                            <td>{{$slider->description1}}</td>
                            <td>{{$slider->description2}}</td>
                            @if ($slider->status == 1)
                              <td>
                                <label class="badge badge-success">Actif</label>
                              </td>   
                            @else
                              <td>
                                <label class="badge badge-danger">Désactivé</label>
                              </td>
                            @endif

                            <td>
                              <button class="btn btn-outline-primary"><a href="{{URL::to('/modifierSlider/'.$slider->id)}}">Modifier</a></button>
                              <button class="btn btn-outline-danger"><a href="{{URL::to('/supprimerSlider/'.$slider->id)}}" id="delete">Supprimer</a></button>
                              @if($slider->status == 1)
                                <button class="btn btn-outline-warning"><a href="{{URL::to('/desactiverSlider/'.$slider->id)}}">Désactiver</a></button>
                              @else
                                <button class="btn btn-outline-success"><a href="{{URL::to('/activerSlider/'.$slider->id)}}">Activer</a></button>
                              @endif
                            </td>
                      </tr>
                      <?php
                      $increment += 1;
                      ?>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endsection
