<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Cart;
use Stripe\Charge;
use Stripe\Stripe;


class ProduitController extends Controller
{
    public function enregistrerProduit(Request $request) {

        if ($request->category == "Selectionner catégorie") {
            # code...
            Session::put('message1', 'Veuillez séléctionner une catégorie...');
            return redirect::to('/ajoutProduit');
        } 
        else {

            $this->validate($request, [
                'productImage' =>'image|nullable|max:1999'
            ]);

            if($request->hasFile('productImage')) {

                // 1 : Get file with name extension
                $fileNameWithExt = $request->file('productImage')->getClientOriginalName();

                // 2 : Get file name only
                $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                //3 : Get the extension only
                $extension = $request->file('productImage')->getClientOriginalExtension();

                //4 : file name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;

                //5 path
                $path = $request->file('productImage')->storeAs('public/cover_images', $fileNameToStore);
            }
            else {
                $fileNameToStore = 'noImage.jpg';
            }





            $data = array();
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['category'] = $request->category;
            $data['productImage'] = $fileNameToStore;
            $data['status'] = $request->status;
        
            DB::table("products")->insert($data);
        
            Session::put('message', 'Produit enregistré');
        
            return redirect::to('/ajoutProduit');
            # code...
        }


    }

    public function selectByCategory($productName) {

        $products = DB::table('products')
                    ->where('category', $productName)
                    ->where('status', '1')
                    ->get();

        $manageProducts = view('client.shop')
                    ->with('products', $products);

        return view('layout.app')
                    ->with('client.shop', $manageProducts);
    }

    public function activerProduit($id) {
        $data = array();
        $data['status'] = 1;


        DB::table('products')
            ->where('id', $id)
            ->update($data);

        Session::put('message', 'Produit activé');
    
        return redirect::to('/produits');
    }

    public function desactiverProduit($id) {
        $data = array();
        $data['status'] = 0;

        DB::table('products')
            ->where('id', $id)
            ->update($data);

        Session::put('message', 'Produit desactivé');
    
        return redirect::to('/produits');
    }

    public function supprimerProduit($id) {

        $produit = DB::table('products')
            ->where('id', $id)
            ->first();

        if($produit->productImage != 'noImage.jpg') {
            Storage::delete('public/cover_images/'.$produit->productImage);
        }

        DB::table('products')
            ->where('id', $id)
            ->delete();

        Session::put('message', 'Produit supprimé');
    
        return redirect::to('/produits');
    }

    public function modifierProduit($id) {

            $products=DB::table('products')
            ->where('id', $id)
            ->first();

            $manageProducts = view('admin.modifierProduit')
            ->with('products', $products);

            return view('layout.appadmin')
            ->with('admin.modifierProduit',$manageProducts);

    }

    public function editProduit(Request $request) {

        if ($request->category == "Selectionner catégorie") {
            # code...
            Session::put('message1', 'Veuillez séléctionner une catégorie...');
            return redirect::to('/modifierProduit/'.$request->id);
        } 
        else {

            $this->validate($request, [
                'productImage' =>'image|nullable|max:1999'
            ]);

            if($request->hasFile('productImage')) {

                // 1 : Get file with name extension
                $fileNameWithExt = $request->file('productImage')->getClientOriginalName();

                // 2 : Get file name only
                $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                //3 : Get the extension only
                $extension = $request->file('productImage')->getClientOriginalExtension();

                //4 : file name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;

                //5 path
                $path = $request->file('productImage')->storeAs('public/cover_images', $fileNameToStore);
            }
            else {
                $fileNameToStore = 'noImage.jpg';
            }





            $data = array();
            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['category'] = $request->category;
            
            if($request->hasFile('productImage')) {
                $products = DB::table('products') 
                            ->where('id', $request->id)
                            ->first();

                $data['productImage'] = $fileNameToStore;
                
                if($products->productImage != 'noImage.jpg') {
                    Storage::delete('/public/cover_images/'. $products->productImage);
                    /* Le prof est nul 
                    // Ligne du prof pour effacer l'image présente dans le dossier.. qui supprime le nom du produit du dossier.. qui n'existe pas.
                    Storage::delete('/public/cover_images/'. $products->name); ??????? 
                    // Mes tests
                    echo '/public/cover_images/'. $products->productImage;
                    return 0;
                    */
                }

            }
            DB::table("products")
                    
                ->where('id', $request->id)
                ->update($data);

        
            Session::put('message', 'Produit modifié');
        
            return redirect::to('/produits');
            # code...
        }

    }

    public function ajoutPanier($id) {
        $product = DB::table('products')
                ->where('id', $id)
                ->first();

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);

        Session::put('cart', $cart);

        //dd(Session::get('cart'));

        return redirect::to('/');

    }

    public function cart() {
        if(!Session::has('cart')) {
            return view('client.cart');
        }

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);

        return view('client.cart', ['products' => $cart->items]);
    }

    public function modifierQty(Request $request) {
        //echo('qty = '.$request->quantity. ' id = '.$request->id);

        $oldCart = Session::has('cart')?Session::get('cart'):null;

        $cart = new Cart($oldCart);
        $cart->modifierQty($request->quantity, $request->id);

        Session::put('cart', $cart);

        //dd(Session::get('cart'));

        return redirect::to('/cart');

    }

    public function enleverItem($id){

        $oldCart = Session::has('cart')?Session::get('cart'):null;

        $cart = new Cart($oldCart);
        $cart->enleverItem($id);

        if (count($cart->items) > 0) {
            # code...
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
            # code...
        }
        
        

        //dd(Session::get('cart'));

        return redirect::to('/cart');

    }

    public function ajoutPanierShop($id) {
        $product = DB::table('products')
                ->where('id', $id)
                ->first();

        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);

        Session::put('cart', $cart);

        //dd(Session::get('cart'));

        return redirect::to('/shop');

    }

    public function payment() {
        if(!Session::has('cart')) {
            return redirect::to('/cart');
        }
        return view('client.payment');
    }

    public function payer(Request $request) {
        if(!Session::has('cart')) {
            return redirect::to('/cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_ET6CaBtp7xaYsQp6Rk7gGTcA00pO9ONeYS');
        try{
            $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "eur",
                "source" => $request->input('stripeToken'), //payment.js
                "description" => "Test Charge"

            ));

            $data = array();
            $data["clientName"] = $request->name ." ". $request->surname;
            $data["clientAddress"] = $request->address;
            $data["cart"] = serialize($cart);
            $data["paymentID"]= $charge->id;

            DB::table('orders')
                ->insert($data);

        } catch(\Exception $e) {
            Session::put('error', $e->getMessage());
            return redirect::to('/payment');
        }

        Session::forget('cart');
        Session::put('success', 'Achat effectué avec succes');
        return redirect::to('/cart');
    }

    public function commandes() {
        return view('admin.commandes');
    }
}
