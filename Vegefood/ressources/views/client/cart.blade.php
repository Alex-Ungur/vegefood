@extends('layout.app')

@section('title')
    Cart
@endsection

@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<!-- <p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Home</a></span> <span>Cart</span></p> -->
            <h1 class="mb-0 bread">Mon panier</h1>
          </div>
        </div>
      </div>
    </div>

	<?php
		$totalPrice = 0;
	?>
	@if (Session::has('cart'))
			<section class="ftco-section ftco-cart">
				<div class="container">
					<div class="row">
					<div class="col-md-12 ftco-animate">
						<div class="cart-list">
							<table class="table">
								<thead class="thead-primary">
								<tr class="text-center">
									<th>&nbsp;</th>
									<th>&nbsp;</th>
									<th>Nom du produit</th>
									<th>Prix</th>
									<th>Quantité</th>
									<th>Modifier Qté</th>
									<th>Total</th>
								</tr>
								</thead>
								<tbody>
									@foreach ($products as $product)
										<tr class="text-center">
											<td class="product-remove"><a href="{{URL::to('/enleverItem/'.$product['productId'])}}"><span class="ion-ios-close"></span></a></td>
											
											<td class="image-prod"><div class="img" style="background-image:url(/storage/cover_images/{{$product['productImage']}});"></div></td>
											
											<td class="product-name">
												<h3>{{$product['productName']}}</h3>
												<p>Far far away, behind the word mountains, far from the countries</p>
											</td>
											
											<td class="price">{{$product['productPrice']}}€</td>
												{{Form::open(['action' => 'ProduitController@modifierQty' ,
												'method' => 'POST', 'class' => 'form-horizontal', 'enctype' => 
												'multipart/form-data'])}}
													<fieldset>
													<td class="quantity">
														<div class="input-group mb-3">
															<input type="number" name="quantity" class="quantity form-control input-number" value="{{$product['qty']}}" min="1" max="100">
															<input type="hidden" name="id" class="quantity form-control input-number" value="{{$product['productId']}}">
														</div>
														<td class="product-quantity"
														<div class="input-group mb-3">
															{{Form::submit('Modifier', ['class' => 'btn btn-primary py-3 px-4'])}}
														</div>
														</td>
													</fieldset>
												{{ Form::close() }}
											</td>
											
											<td class="total">{{$product['qty'] * $product['productPrice']}} €</td>
										</tr><!-- END TR-->
										<?php
											$totalPrice += $product['qty'] * $product['productPrice'];
										?>

									@endforeach								
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row justify-content-end">
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Coupon Code</h3>
							<p>Enter your coupon code if you have one</p>
							<form action="#" class="info">
					<div class="form-group">
						<label for="">Coupon code</label>
						<input type="text" class="form-control text-left px-3" placeholder="">
					</div>
					</form>
						</div>
						<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
					</div>
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Estimate shipping and tax</h3>
							<p>Enter your destination to get a shipping estimate</p>
							<form action="#" class="info">
					<div class="form-group">
						<label for="">Country</label>
						<input type="text" class="form-control text-left px-3" placeholder="">
					</div>
					<div class="form-group">
						<label for="country">State/Province</label>
						<input type="text" class="form-control text-left px-3" placeholder="">
					</div>
					<div class="form-group">
						<label for="country">Zip/Postal Code</label>
						<input type="text" class="form-control text-left px-3" placeholder="">
					</div>
					</form>
						</div>
						<p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
					</div>
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Cart Totals</h3>
							<hr>
							<p class="d-flex total-price">
								<span>Total</span>
							<span>{{$totalPrice}} €</span>
							</p>
						</div>
						<p><a href="{{URL::to('/payment')}}" class="btn btn-primary py-3 px-4">Se diriger vers le paiement</a></p>
					</div>
				</div>
				</div>
		</section>


		
	@else
	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">

			<?php
				$success = Session::get('success');
			?>
			@if ($success)
				<p class="alert alert-success">
					<?php
						echo $success;
						Session::put('success', null);
					?>
				</p>
			@endif

			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 30px;" class="mb-0">Panier vide</h2>
				</div>
			</div>
		</div>
	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Souscrivez à notre newsletter</h2>
					<span>Get e-mail updates about our latest shops and special offers</span>
				</div>
				<div class="col-md-6 d-flex align-items-center">
					<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<input type="text" class="form-control" placeholder="Enter email address">
							<input type="submit" value="Subscribe" class="submit px-3">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

		
	@endif
@endsection
@section('script')
<script>
    $(document).ready(function(){

    var quantitiy=0;
       $('.quantity-right-plus').click(function(e){
            
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
                
                $('#quantity').val(quantity + 1);

              
                // Increment
            
        });

         $('.quantity-left-minus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());
            
            // If is not undefined
          
                // Increment
                if(quantity>0){
                $('#quantity').val(quantity - 1);
                }
        });
        
    });
</script>
@endsection
