@extends('layout.appadmin')

@section('content')
    
<?php 

$products = DB::table('products')->get();
$increment = 1;

?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Produits</h4>

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
                            <th>Commande n°</th>
                            <th>Nom</th>
                            <th>Image</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                            
                        
                          <tr>
                              <td>{{$increment}}</td>
                              <td>{{$product->name}}</td>
                              <td><img src="storage/cover_images/{{$product->productImage}}" alt=""></td>
                              <td>{{$product->price}} €</td>
                              <td>{{$product->category}}</td>
                              
                              @if ($product->status == 1)
                                <td>
                                  <label class="badge badge-success">Actif</label>
                                </td>   
                              @else
                                <td>
                                  <label class="badge badge-danger">Désactivé</label>
                                </td>
                              @endif

                              <td>
                                <button class="btn btn-outline-primary"><a href="{{URL::to('/modifierProduit/'.$product->id)}}">Modifier</a></button>
                                <button class="btn btn-outline-danger"><a href="{{URL::to('/supprimerProduit/'.$product->id)}}" id="delete">Supprimer</a></button>
                                @if($product->status == 1)
                                  <button class="btn btn-outline-warning"><a href="{{URL::to('/desactiverProduit/'.$product->id)}}">Désactiver</a></button>
                                @else
                                  <button class="btn btn-outline-success"><a href="{{URL::to('/activerProduit/'.$product->id)}}">Activer</a></button>
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
