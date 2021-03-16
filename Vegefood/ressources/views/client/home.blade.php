@extends('layout.app')

@section('content')

@section('title')
    Home
@endsection


<?php 

$sliders = DB::table('sliders')
            ->where('status', 1)
            ->get();
$products = DB::table('products')
            ->where('status', 1)    
            ->get();

?>
{{-- AU --}}

<section id="home-section" class="hero">
      <div class="home-slider owl-carousel">
        @foreach ($sliders as $slider)
        
        <div class="slider-item" style="background-image: url(storage/slider_images/{{$slider->sliderImage}});">
            <div class="overlay"></div>
          <div class="container">
            <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
  
              <div class="col-md-12 ftco-animate text-center">
                <h1 class="mb-2">{{$slider->description1}}</h1>
                <h2 class="subheading mb-4">{{$slider->description2}}</h2>
                <p><a href="#" class="btn btn-primary">Plus de détails</a></p>
              </div>
  
            </div>
          </div>
        </div>
            
        @endforeach
    </div>
</section>

<section class="ftco-section">
        <div class="container">
            <div class="row no-gutters ftco-services">
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-shipped"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Livraison gratuite</h3>
            <span>A partir de 40€ d'achats</span>
          </div>
        </div>      
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-diet"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Toujours frais</h3>
            <span>Emballage respectant l'environnement</span>
          </div>
        </div>    
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-award"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Produits de qualité</h3>
            <span>100% Bio issus de producteurs français</span>
          </div>
        </div>      
      </div>
      <div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
        <div class="media block-6 services mb-md-0 mb-4">
          <div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
                <span class="flaticon-customer-service"></span>
          </div>
          <div class="media-body">
            <h3 class="heading">Support</h3>
            <span>Support 24/7</span>
          </div>
        </div>      
      </div>
    </div>
        </div>
    </section>

    <section class="ftco-section ftco-category ftco-no-pt">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 order-md-last align-items-stretch d-flex">
                            <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url(frontend/images/category.jpg);">
                                <div class="text text-center">
                                    <h2>Legumes</h2>
                                    <p>Protect the health of every home</p>
                                    <p><a href="{{URL::to('/shop')}}" class="btn btn-primary">Acheter</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/category-1.jpg);">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="{{URL::to('/selectByCategory/Legumes')}}">Legumes</a></h2>
                                </div>
                            </div>
                            <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(frontend/images/category-2.jpg);">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="{{URL::to('/selectByCategory/Fruits')}}">Fruits</a></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url(frontend/images/category-3.jpg);">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="{{URL::to('/selectByCategory/Jus')}}">Jus</a></h2>
                        </div>		
                    </div>
                    <div class="category-wrap ftco-animate img d-flex align-items-end" style="background-image: url(frontend/images/category-4.jpg);">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="{{URL::to('/selectByCategory/Autres')}}">Autres produits</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="ftco-section">
    <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
          <span class="subheading">Produits mis en avant</span>
        <h2 class="mb-4">Nos produits</h2>
        <p>Retrouvez tout notre gamme de produits frais </p>
      </div>
    </div>   		
    </div>
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
            <div class="col-md-6 col-lg-3 ftco-animate">
                <div class="product">
                    <a href="#" class="img-prod"><img class="img-fluid" src="storage/cover_images/{{$product->productImage}}" alt="Colorlib Template">
                        <span class="status">30%</span>
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="#">{{$product->name}}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="mr-2 price-dc">{{$product->price}}€</span><span class="price-sale">{{$product->price - ($product->price*0.3)}}€</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                              <a href="{{URL::to('/ajoutPanier/'.$product->id)}}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                                <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                    <span><i class="ion-ios-heart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
    
    <section class="ftco-section img" style="background-image: url(frontend/images/bg_3.jpg);">
    <div class="container">
            <div class="row justify-content-end">
      <div class="col-md-6 heading-section ftco-animate deal-of-the-day ftco-animate">
          <span class="subheading">Meilleurs prix</span>
        <h2 class="mb-4">Offre promotionnelle</h2>
        <p>Profitez de nos bas prix à temps limité</p>
        <h3><a href="{{URL::to("/shop/")}}">Reduction sur tout le site</a></h3>
        <h3>Promotion -30% prenant fin dans : </h3>
        <div id="timer" class="d-flex mt-5">
          <!-- modifier dans main.js makeTimer() -->
                      <div class="time" id="Jours"></div>
                      <div class="time pl-3" id="heures"></div>
                      <div class="time pl-3" id="minutes"></div>
                      <div class="time pl-3" id="secondes"></div>
                    </div>
      </div>
    </div>   		
    </div>
</section>

<section class="ftco-section testimony-section">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
          <span class="subheading">Avis</span>
        <h2 class="mb-4">L'avis de nos clients</h2>
      </div>
    </div>
    <div class="row ftco-animate">
      <div class="col-md-12">
        <div class="carousel-testimony owl-carousel">
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(frontend/images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Duis dapibus odio erat, sit amet sagittis lorem fringilla ut. Vivamus libero neque, convallis ut lorem et, tempor egestas ex. Morbi metus mi, accumsan vel ante sed, accumsan aliquam ex.</p>
                <p class="name">Rafael Henry</p>
                <span class="position">Marketing Manager</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(frontend/images/person_2.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Phasellus fermentum ligula consequat posuere pellentesque. Pellentesque vitae purus a risus tempor egestas sed vestibulum leo.</p>
                <p class="name">Marin Clement</p>
                <span class="position">Interface Designer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(frontend/images/person_3.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Nulla ut mattis neque, id feugiat est. Donec commodo semper odio. Mauris sit amet dolor lacinia, facilisis elit sed, accumsan est.</p>
                <p class="name">Damien Robin</p>
                <span class="position">UI Designer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(frontend/images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Maecenas eget ex id tortor accumsan facilisis. In hac habitasse platea dictumst. Phasellus vitae finibus tellus. Sed et nunc pulvinar, luctus libero eu, varius ipsum. </p>
                <p class="name">Oscar Bruno</p>
                <span class="position">Web Developer</span>
              </div>
            </div>
          </div>
          <div class="item">
            <div class="testimony-wrap p-4 pb-5">
              <div class="user-img mb-5" style="background-image: url(frontend/images/person_1.jpg)">
                <span class="quote d-flex align-items-center justify-content-center">
                  <i class="icon-quote-left"></i>
                </span>
              </div>
              <div class="text text-center">
                <p class="mb-5 pl-4 line">Nunc eget volutpat diam. Maecenas vel tempor nisl. In quis leo in urna luctus mattis. Duis ac ex imperdiet, blandit diam quis, eleifend tellus.</p>
                <p class="name">Amand Hector</p>
                <span class="position">System Analyst</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<hr>

    <section class="ftco-section ftco-partner">
    <div class="container">
        <div class="row">
            <div class="col-sm ftco-animate">
                <a href="#" class="partner"><img src="frontend/images/partner-1.png" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-sm ftco-animate">
                <a href="#" class="partner"><img src="frontend/images/partner-2.png" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-sm ftco-animate">
                <a href="#" class="partner"><img src="frontend/images/partner-3.png" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-sm ftco-animate">
                <a href="#" class="partner"><img src="frontend/images/partner-4.png" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-sm ftco-animate">
                <a href="#" class="partner"><img src="frontend/images/partner-5.png" class="img-fluid" alt="Colorlib Template"></a>
            </div>
        </div>
    </div>
</section>

    <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
  <div class="container py-4">
    <div class="row d-flex justify-content-center py-5">
      <div class="col-md-6">
          <h2 style="font-size: 22px;" class="mb-0">Souscrivez à la newsletter</h2>
          <span>Recevez nos dernieres mises à jour par mail</span>
      </div>
      <div class="col-md-6 d-flex align-items-center">
        <form action="#" class="subscribe-form">
          <div class="form-group d-flex">
            <input type="text" class="form-control" placeholder="Entrez votre adresse mail">
            <input type="submit" value="Subscribe" class="submit px-3">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection