@extends('layout.app')


@section('title')
    Checkout
@endsection

@section('content')


    <div class="hero-wrap hero-bread" style="background-image: url('frontend/images/bg_1.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Home</a></span> <span>Checkout</span></p>
            <h1 class="mb-0 bread">Checkout</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-7 ftco-animate">
			{{Form::open(['action' => 'ProduitController@payer' ,
			'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'checkout-form', 'enctype' => 
			'multipart/form-data'])}}
				<fieldset>
				<h3 class="mb-4 billing-heading">Adresse de facturation</h3>
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
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="firstname">Nom</label>
	                  <input type="text" class="form-control" placeholder="" name="name">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="lastname">Prénom</label>
	                  <input type="text" class="form-control" placeholder="" name="surname">
	                </div>
                </div>
				<div class="w-100"></div>
				<!-- ICI IL VOULAIT FINIR CPD -->
				<!--
		            <div class="col-md-12">
						
		            	<div class="form-group">
		            		<label for="country">Pays</label>
		            		<div class="select-wrap">
		                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                  <select name="" id="" class="form-control">
		                  	<option value="">France</option>
		                    <option value="">Italie</option>
		                    <option value="">Espagne</option>
		                    <option value="">Allemagne</option>
		                    <option value="">Portugal</option>
							<option value="">Pays Bas</option>
							<option value="">Angleterre</option>
		                  </select>
		                </div>
		            	</div>
					</div>
					-->
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="streetaddress">Adresse</label>
	                  <input type="text" class="form-control" placeholder="Numéro et nom de la rue/avenue" name="address">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                  <input type="text" class="form-control" placeholder="Appartment, étage, etc: (facultatif)">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="towncity">Ville</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
		            		<label for="postcodezip">Code postal</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
		            </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
	                <div class="form-group">
	                	<label for="phone">Tél</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="emailaddress">Email</label>
	                  <input type="text" class="form-control" placeholder="">
	                </div>
				  </div>
				  <div class="col-md-12">
					<div class="form-group">
						<label for="card-name">Nom titulaire carte</label>
				 		<input type="text" class="form-control" placeholder="" id="card-name">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="card-number">Numéro de carte de paiement</label>
				  		<input type="text" class="form-control" placeholder="XXXX-XXXX-XXXX-XXXX" id="card-number">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="card-expiry-month">Mois d'expiration</label>
				  		<input type="text" class="form-control" placeholder="01" id="card-expiry-month">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="card-expiry-year">Année d'expiration</label>
				  		<input type="text" class="form-control" placeholder="21" id="card-expiry-year">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="cvc">CVC</label>
				 		<input type="text" class="form-control" placeholder="XXX" id="card-cvc">
					</div>
				</div>

			</div>
			<p><input class="btn btn-primary py-3 px-4" type="submit" value ="Proceder au paiement"></p>
			</fieldset>
			{{ Form::close() }}
			  <!-- END -->
			  
					</div>
					<div class="col-xl-5">
	          <div class="row mt-5 pt-3">
	          	<div class="col-md-12 d-flex mb-5">
	          		<div class="cart-detail cart-total p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Total</span>
		    						<span>{{Session::get('cart')->totalPrice}} €</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Livraison</span>
		    						<span>$0.00</span>
		    					</p>
		    					<p class="d-flex">
		    						<span>Discount</span>
		    						<span>$3.00</span>
		    					</p>
		    					<hr>
		    					<p class="d-flex total-price">
		    						<span>Total</span>
		    						<span>$17.60</span>
		    					</p>
								</div>
				  </div>
				<!--
	          	<div class="col-md-12">
	          		<div class="cart-detail p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="radio">
											   <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div class="checkbox">
											   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
											</div>
										</div>
									</div>
									<p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p>
								</div>
							-->
	          	</div>
			  </div>
			  <!-- ICI IL VOULAIT FINIR CPD -->
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
	<!--
		<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
      <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
          <div class="col-md-6">
          	<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
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
	-->
    @endsection
    @section('script')
		
		
	<script src="https://js.stripe.com/v2/"></script>
	<script src="src/js/payment.js"></script>

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
