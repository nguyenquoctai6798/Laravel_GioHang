<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public static function payment($email, $totalPay, $lsProductPayment){
        $payment = new Payment;
        $payment->gmail = $email;
        $payment->totalPay = $totalPay;
        $payment->lsProduct = json_encode($lsProductPayment);
        $payment->save();
        session()->forget('cart');
    }

    public static function getAllCartPayment(){
        $lsPayment = Payment::all();
        return $lsPayment;
    }

    public static function getCarPaymentById($id){
        $Cart = Payment::where('id', $id)->get()->first();
        return $Cart;
    }
}
