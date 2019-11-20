<?php

namespace App\Http\Controllers;
use Auth;
use App\Payment;
use App\Producttype;
use App\Products;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment(Request $request){
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            $cart = $request->session()->get('cart');
            if ($cart) {
                $totalPay = 0;
                $lsProductPayment = $request->session()->get('cart');
                foreach ($lsProductPayment as $key => $item) {
                    $totalPay = $totalPay + $item['Price'] * $item['quantity'];
                }
                $email =  Auth::user()->email;
                Payment::payment($email, $totalPay, $lsProductPayment);
                return redirect('/')->with('success', 'Thanh toán thành công');
            }
            return redirect('/')->with('error', 'Vui lòng chọn sản phẩm vào giỏ hàng trước khi thanh toán');
        }else{
            return redirect('/Login')->with('error', 'Vui lòng đăng nhập để thanh toán');
        }
    }

    public function showAllCartPayment(){
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $lsPayment = Payment::getAllCartPayment();
                return view('CartPaymentManagement', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'lsPayment' => $lsPayment]);
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function detailCartPaymentManagement($id){
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $Cart = Payment::getCarPaymentById($id);
                if ($Cart) {
                    $user = User::getAccountbyMail($Cart->gmail);
                    $lsProduct = json_decode($Cart->lsProduct);
                    $totalPay = $Cart->totalPay;
                    return view('DetailCartPaymentManagement', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'user' => $user, 'lsProduct'=>$lsProduct, 'totalPay' => $totalPay]);
                }
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function CountHome(){
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
               
               
            }
        }
    }
}
