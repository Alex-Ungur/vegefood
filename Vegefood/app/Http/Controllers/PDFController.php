<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Session;
Use Illuminate\Support\Facades\Redirect;
Use Illuminate\Support\Facades\Storage;


class PdfController extends Controller
{
    //

    public function voirPDF($id){
        Session::put('id', $id);
        try{
            $pdf = \App::make('dompdf.wrapper')->setPaper('a4', 'landscape');
            $pdf->loadHTML($this->convert_orders_data_to_html());

            return $pdf->stream();
        }
        catch(\ Exception $e){
            return redirect::to('/commandes')->with('error', $e->getMessage());
        }
    }

    public function convert_orders_data_to_html(){
        
        $orders = DB::table('orders')
                    ->where('id',Session::get('id'))
                    ->get();
        
        $name;
        $address;
        $date;
        $totalPrice;

        foreach($orders as $order){
            $name = $order->clientName;
            $address = $order->clientAddress;
            $date = $order->date;
        }

        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });



        $output = '<link rel="stylesheet" href="frontend/css/style.css">
                        <table class="table">
                            <thead class="thead">
                                <tr class="text-left">
                                    <th>Nom du client : '.$name.'<br> Adresse du client : '.$address.' <br> Date : '.$date.'</th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Image</th>
                                    <th>Nom produit</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>';
        
        foreach($orders as $order){
            foreach($order->cart->items as $item){

                $output .= '<tr class="text-center">
                                <td class="image-prod"><img src="storage/cover_images/'.$item['productImage'].'" alt="" style = "height: 80px; width: 80px;"></td>
                                <td class="product-name">
                                    <h3>'.$item['productName'].'</h3>
                                </td>
                                <td class="price">$ '.$item['productPrice'].'</td>
                                <td class="qty">'.$item['qty'].'</td>
                                <td class="total">$ '.$item['productPrice']*$item['qty'].'</td>
                            </tr><!-- END TR-->
                            </tbody>';

            }

            $totalPrice = $order->cart->totalPrice; 

        }

        $output .='</table>';

        $output .='<table class="table">
                        <thead class="thead">
                            <tr class="text-center">
                                    <th>Total</th>
                                    <th>$ '.$totalPrice.'</th>
                            </tr>
                        </thead>
                    </table>';


        return $output;
                
    }
}
