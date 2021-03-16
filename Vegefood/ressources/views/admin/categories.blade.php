@extends('layout.appadmin')

@section('content')

<?php 

$categories = DB::table('categories')->get();
$increment = 1;

?>
    
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Catégories</h4>
              
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

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                          <tr>
                          <td>{{$increment}}</td>
                            <td>{{$category->name}}</td>
                              <td>
                                <button class="btn btn-outline-primary"><a href="{{URL::to('/modifierCategorie/'.$category->id)}}">Modifier</a></button>
                                <button class="btn btn-outline-danger"><a href="{{URL::to('/supprimerCategorie/'.$category->id)}}" id="delete">Supprimer</a></button>
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
