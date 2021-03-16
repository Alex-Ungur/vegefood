<?php
namespace App;

class Cart {
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart) {
        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $productId) {
        $storedItem = 
        [
            'qty' => 0, 
            'productId' => 0, 
            'productName' => $item->name,
            'productPrice' => $item->price,
            'productImage' => $item->productImage,
            'item' => $item
        ];

        if($this->items) {
            if(array_key_exists($productId, $this->items)) {
                $storedItem = $this->items[$productId];
            }
        }
        
        $storedItem['qty']++;
        $storedItem['productId'] = $productId;
        $storedItem['productName'] = $item->name;
        $storedItem['productPrice'] = $item->price;
        $storedItem['productImage'] = $item->productImage;

        $this->totalQty++;
        $this->totalPrice += $item->price;
        $this->items[$productId] = $storedItem;
    }

    public function modifierQty($qty, $id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['productPrice']*$this->items[$id]['qty'];
        $this->items[$id]['qty'] = $qty;
        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['productPrice']*$qty;
    }

    public function enleverItem($id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['productPrice']*$this->items[$id]['qty'];
        unset($this->items[$id]);
    }
}
?>