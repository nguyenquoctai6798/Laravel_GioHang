<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Products;
use App\Producttype;
use App\Payment;
use App\NotificationType;
use Illuminate\Support\Facades\Hash;
use Mail;
use Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('Login');
    }

    public function register()
    {
        return view('Register');
    }

    public function home()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $lsPayment = Payment::getAllCartPayment();
                $lsProduct = Products::getAllProduct();
                $lsProductType = Producttype::getAllProductType();
                $lsUser = User::getAllUser();
               $countPayment = count($lsPayment);
               $countProduct = count($lsProduct);
               $countProductType = count($lsProductType);
               $countUser = count($lsUser);
                return view('HomeAdmin',['name' => Auth::user()->name, 'img' => Auth::user()->img, 'countPayment' => $countPayment, 'countProduct' => $countProduct, 'countProductType' => $countProductType, 'countUser' => $countUser]);
            } else if (Auth::user()->role == 0) {
                $lsProductType = Producttype::getAllProductType();
                $lsProduct = Products::getAllProduct();
                $lsNotificationType = NotificationType::getAllNotificationType();

                return view('HomeUser', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'lsProductType' => $lsProductType, 'lsProduct' => $lsProduct, 'lsNotificationType' => $lsNotificationType]);
            }
        } else {
            $lsProductType = Producttype::getAllProductType();
            $lsProduct = Products::getAllProduct();
            $lsNotificationType = NotificationType::getAllNotificationType();
            return view('HomeGues', ['lsProductType' => $lsProductType, 'lsProduct' => $lsProduct, 'lsNotificationType' => $lsNotificationType]);
        }
    }

    public function getAllUser(){
        $lsUser = User::getAllUser();
        return view('UserManagement', ['lsUser' => $lsUser]);
    }

 

    public function registerPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'retypepassword'=>'required_with:password|same:password|min:6',
            'myfile' => 'required|max:10000'
       ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->except('RetypePassword', 'Password'))->with('errors', $validator->errors());
        } else {
            $user = User::checkAccount($request->email);
            if ($user != null) {
                return redirect()->back()->with('error', 'Email đã được đăng ký')->withInput(
                    $request->except('password')
                );
            } else {
                if ($request->hasFile('myfile')) {
                    $file = $request->file('myfile');
                    $duoi = $file->getClientOriginalExtension();
                    if ($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg" && $duoi != "JPG" && $duoi != "PNG" && $duoi != "JPEG") {
                        return redirect()->back()->with('error', 'Chỉ được thêm file .jpg/.png/.jpeg')->withInput(
                            $request->except('')
                        );
                    } else {
                        $fileName = $file->getClientOriginalName();
                        $fileRandom = str_random(8). '_' .$fileName;
                        $file->move('public/img', $fileRandom);
                        $data = array('token'=> $request['_token'], 'email' => $request['mail'] );
                        $mail = $request['email'];
                        Mail::send('mail', $data, function ($message) use ($mail) {
                            $message->to($mail, 'Tutorials Point')->subject('Confirm Email');
                            $message->from('taiphotographer6798@gmail.com', 'Admin');
                        });
                        User::createAccount($request, $fileRandom);
                        return redirect('/Login')->with('success', 'Bạn đã tạo tài khoản thành công, Vui lòng check mail để xác thực');
                    }
                }
                else{
                    return redirect()->back()->with('error', 'Không tìm thầy file')->withInput(
                        $request->except('')
                    );
                }
            }
        }
    }

    public function conFirm($token)
    {
        $check = User::conFirm($token);
        if ($check == 'error') {
            return redirect('/Login')->with('error', 'Token xác thưc không chính xác');
        } else {
            return redirect('/Login')->with('success', 'Xác thực thành công. Vui lòng đăng nhập');
        }
    }

    public function loginPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'=> 'required|min:6'
        ]);
        if ($validator->fails()) {
            $request->session()->flash('errors', $validator->errors());
            return redirect()->back()->withInput($request->except('password'));
        } else {
            $account = User::checkAccount($request->email);
            if ($account === null) {
                $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
                return redirect()->back()->withInput($request->except('password'));
            } else {
                if (Hash::check($request->password, $account->password)) {
                    if (Auth::attempt(['email' => $request->email, 'password'=> $request->password ])) {
                        if (Auth::user()->email_verified_at == 1 && Auth::user()->role == 0) {
                           return redirect('/');
                        } elseif (Auth::user()->email_verified_at == 1 && Auth::user()->role == 1) {
                            return redirect('/')->with('success', 'Đăng nhập với quyền Admin thành công');
                        } else {
                            return redirect()->back()->with('error', 'Vui lòng xác thực email để đăng nhập!');
                        }
                    } else {
                        return 'fails';
                    }
                } else {
                    $request->session()->flash('error', 'Tài khoản hoặc mật khẩu không chính xác');
                    return redirect()->back()->withInput($request->except('password'));
                }
            }
        }
    }

    public function logOut(Request $request)
    {
        if(Auth::user()->role == 0)
        {
            Auth::logout();
            return redirect('/');
        }
        else if(Auth::user()->role == 1){
            Auth::logout();
            return redirect('/Login');
        }
       
    }

 
}
