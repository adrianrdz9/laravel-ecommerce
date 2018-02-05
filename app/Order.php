<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;
use App\Mail\OrderUpdated;

class Order extends Model
{

    protected $fillable = ['recipient_name', 'line1', 'line2', 'city', 'country_code', 'state', 'postal_code',
                            'email', 'shopping_cart_id', 'status', 'total', 'guide_number'];

    public static function createFromPayPalResonse($response, $shopping_cart){
        $payer = $response->payer;

        $orderData =  (array) $payer->payer_info->shipping_address;

        $orderData = $orderData[key($orderData)];

        $orderData["email"] = $payer->payer_info->email;
        $orderData["total"] = $shopping_cart->total();
        $orderData["shopping_cart_id"] = $shopping_cart->id;

        return Order::create($orderData);
    }

    public static function totalMonth(){
        return Order::monthly()->sum('total');
    }

    public static function totalMonthCount(){
        return Order::monthly()->count();
    }

    public function address(){
        return "$this->line1 $this->line2";
    }

    public function scopeLatests($query){
        return $query->orderId()->monthly();
    }

    public function scopeOrderId($query){
        return $query->orderBy('id', 'desc');
    }

    public function scopeMonthly($query){
        return $query->whereMonth('created_at', '=', date('m'));
    }

    public function sendMail(){
        Mail::to('adrian.rodriguez7109@gmail.com')->send(new OrderCreated($this));
    }

    public function shoppingCart(){
        return $this->belongsTo('App\ShoppingCart');
    }

    public function shoppingCartId(){
        return $this->shoppingCart->customid;
    }

    public function sendUpdateMail(){
        Mail::to('adrian.rodriguez7109@gmail.com')->send(new OrderUpdated($this));
    }

}
