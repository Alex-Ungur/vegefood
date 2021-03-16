<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', 'ClientController@home');
Route::get('/shop', 'ClientController@shop');
//Route::get('/cart', 'ClientController@cart');
//Route::get('/payment', 'ClientController@payment');

//Partie Admin app\Http\Controllers\
Route::get('/admin', 'AdminController@admin');
Route::get('/ajoutCategorie', 'AdminController@ajoutCategorie');
Route::get('/ajoutProduit', 'AdminController@ajoutProduit');
Route::get('/ajoutSlider', 'AdminController@ajoutSlider');
Route::get('/categories', 'AdminController@categories');
Route::get('/produits', 'AdminController@produits');
Route::get('/sliders', 'AdminController@sliders');

Route::post('/enregistrerProduit', 'ProduitController@enregistrerProduit');
Route::post('/enregistrerCategorie', 'CategoryController@enregistrerCategorie');
Route::post('/enregistrerSlider', 'SliderController@enregistrerSlider');

Route::get('/selectByCategory/{productName}', 'ProduitController@selectByCategory');

Route::get('/activerProduit/{id}', 'ProduitController@activerProduit');
Route::get('/desactiverProduit/{id}', 'ProduitController@desactiverProduit');
Route::get('/supprimerProduit/{id}', 'ProduitController@supprimerProduit');

Route::get('/activerSlider/{id}', 'SliderController@activerSlider');
Route::get('/desactiverSlider/{id}', 'SliderController@desactiverSlider');
Route::get('/supprimerSlider/{id}', 'SliderController@supprimerSlider');

Route::get('/supprimerCategorie/{id}', 'CategoryController@supprimerCategorie');
Route::get('/modifierCategorie/{id}', 'CategoryController@modifierCategorie');
Route::post('/editCategorie/', 'CategoryController@editCategorie');

Route::get('/modifierProduit/{id}', 'ProduitController@modifierProduit');
Route::post('/editProduit/', 'ProduitController@editProduit');

Route::get('/modifierSlider/{id}', 'SliderController@modifierSlider');
Route::post('/editSlider/', 'SliderController@editSlider');

// Partie Panier
Route::get('/ajoutPanier/{id}', 'ProduitController@ajoutPanier');
Route::get('/cart', 'ProduitController@cart');
Route::post('/modifierQty', 'ProduitController@modifierQty');
Route::get('/enleverItem/{id}', 'ProduitController@enleverItem');
Route::get('/ajoutPanierShop/{id}', 'ProduitController@ajoutPanierShop');
Route::get('/payment', 'ProduitController@payment');
Route::post('/payer','ProduitController@payer');

Route::get('/commandes', 'ProduitController@commandes');
Route::get('/voirPDF/{id}', 'PDFController@voirPDF');





