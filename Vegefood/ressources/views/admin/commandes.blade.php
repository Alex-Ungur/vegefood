@extends('layout.appadmin')

@section('content')
<?php 

$orders = DB::table('orders')
//          ->where('status', 1)
          ->get();
$increment = 1;

$orders->transform(function($order, $key) {
    $order->cart = unserialize($order->cart);

    return $order;
});

?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Commandes</h4>

              <?php
                  $error = Session::get('error');
              ?>
              @if ($error)
                  <p class="alert alert-danger">
                      <?php
                          echo $error;
                          Session::put('error', null);
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
                            <th>Date</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Panier</th>
                            <th>ID de paiement</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{$increment}}</td>
                            <td>{{$order->date}}</td>
                            <td>{{$order->clientName}}</td>
                            <td>{{$order->clientAddress}}</td>
                            <td>
                                @foreach ($order->cart->items as $item)
                                    {{$item['productName']. ' , '}}
                                @endforeach
                            </td>
                            <td>{{$order->paymentID}}</td>

                            <td>
                              <button class="btn btn-outline-primary"><a href="{{URL::to('/voirPDF/'.$order->id)}}">PDF</a></button>
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
