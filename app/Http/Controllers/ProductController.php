<?php

namespace App\Http\Controllers;

use App\Producttype;
use App\Products;
use Illuminate\Http\Request;
use Validator;
use Auth;

class ProductController extends Controller
{
    public function showProductType()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1 || Auth::user()->role == 0) {
                $lsProductType = Producttype::getAllProductType();
                return view('ProductTypeManagement', ['lsProductType' => $lsProductType]);
            
            }
        } else {
            return redirect('/Login');
        }
    }
    public function addProductType(Request $request)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                Producttype::addProductType($request);
                return redirect()->back()->with('success', 'Thêm sản phẩm thành công');
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function deleteProductType($id)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                Producttype::deleteProductType($id);
                return redirect('/ProductTypeManagement')->with('success', 'Xóa loại sản phẩm thành công');
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function showProductManagement()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $lsProduct = Products::getAllProduct();
                return view('ProductManagement', ['lsProduct' => $lsProduct]);
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function createProduct()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $lsProducttype = Producttype::getAllProductType();
                return view('CreateProduct', ['lsProducttype' => $lsProducttype]);
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirecut('/Login');
        }
    }

    public function createProductPost(Request $request)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $validator = Validator::make($request->all(), [
            'Name' => 'required|min:6',
            'Price' => 'required|numeric',
            'Description' => 'required|min:10',
            'myfile' => 'required|max:10000'
        ]);
                if ($validator->fails()) {
                    $request->session()->flash('errors', $validator->errors());
                    $input = $request;
                    return redirect()->back()->withInput(
                        $request->except('')
                    );
                }
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
                        $file->move('public/Images', $fileRandom);
                        products::creteProductPost($request, $fileRandom);
                        return redirect('/ProductManagement')->with('success', 'Tạo sản phẩm thành công!');
                    }
                }
            } else {
                return redirect()->back();
            }
        }
        else {
            return redirect("/Login");
        }
    }

    public function deleteProduct($id)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                products::deleteProduct($id);
                return redirect('/ProductManagement')->with('success', 'Xóa sản phẩm thành công');
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function editProduct($id){
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            $product = products::getProductId($id);
            if(($product[0]->user_id == Auth::user()->id) || Auth::user()->role == 1){
                return view('EditProduct', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'product'=> $product]);
            }
            else{
                    return redirect('/ProductManagement')->with('error', 'Bạn không có sản phẩm này');
            }
        }
        else{
            return redirect('/Login');
        }
       
    }

    public function editProductPost(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'Name' => 'required|min:6',
            'Price' => 'required|numeric',
            'Description' => 'required|min:10',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('errors', $validator->errors());
            return redirect()->back()->withInput(
                $request->except('')
            );
        }
        $fileName = null;
        $fileRandom = null;
        if($request->hasFile('myfile')){
            $file = $request->file('myfile');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg" && $duoi != "JPG" && $duoi != "PNG" && $duoi != "JPEG" ){
                return redirect()->back()->with('error', 'Chỉ được thêm file .jpg/.png/.jpeg')->withInput(
                    $request->except('')
                );
            }
            else{
                // xóa file product cũ
                $product = products::getProductId($id);
                $uploadDir = public_path('Images');
                if(File::exists($uploadDir. '/' . $product[0]->Img)){
                    File::delete($uploadDir. '/' . $product[0]->Img);
                }
                else{
                    return redirect()->back()->with('error', 'file hình không tìm thấy để xóa');
                }
                // thêm file product mới
                $fileName = $file->getClientOriginalName();
                $fileRandom = str_random(8). '_' .$fileName;
                $file->move('public/Images',$fileRandom);
               
            }
        }
        products::editProduct($request, $id, $fileRandom);
        return redirect('/ProductManagement')->with('success', 'Thay đối sản phẩm thành công');
    }


    public function productByProductType($id)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            $lsProductType = Producttype::getAllProductType();
            $lsProduct = Products::productByProductType($id);
            return view('HomeUser', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'lsProductType' => $lsProductType, 'lsProduct' => $lsProduct]);
            // return redirect()->route('home', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'lsProductType' => $lsProductType, 'lsProduct' => $lsProduct]);
        }
        else{
            $lsProductType = Producttype::getAllProductType();
            $lsProduct = Products::productByProductType($id);
            return view('HomeGues', [ 'lsProductType' => $lsProductType, 'lsProduct' => $lsProduct]);
        }
    }
    
    public static function buyProduct(Request $request, $id)
    {
      
            $product = Products::where('id', $id)->get()->first();
            if (!$product) {
                return redirect()->back()->with('success', 'Sản phẩm không tồn tại!');
            }
            $cart = array();
            $cart = $request->session()->get('cart');
            if (!$cart) {
                $cart = [
                $id=>["quantity"=> 1,
                    "Id" => $id,
                    "Name" => $product->Name,
                    "Img" => $product->Img,
                    "Price" => $product->Price,
                    
                ]
                ];
                $request->session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
            }

            if (isset($cart[$id])) {
                $cart[$id]["quantity"]++;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
            }

            $cart[$id] = [
            "quantity"=> 1,
            "Id" => $id,
            "Name" => $product->Name,
            "Img" => $product->Img,
            "Price" => $product->Price,
   
        ];
       
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Thêm sản phẩm vào giỏ hàng thành công!');
        }


    public function cartPayment(Request $request){
        
            $lsProductType = Producttype::getAllProductType();
            $lsProductPayment = $request->session()->get('cart');
            $totalPay = 0;
            if ($lsProductPayment) {
                foreach ($lsProductPayment as $key => $item) {
                    $totalPay = $totalPay + $item['Price'] * $item['quantity'];
                }
                return view('CartPaymentGues', [ 'lsProductType' => $lsProductType, 'lsProductPayment' => $lsProductPayment, 'totalPay'=> $totalPay]);
            }
            return redirect("/")->with('error', 'Chưa có sản phẩm nào trong giỏ hàng');
        }

    public function addProductSession(Request $request, $id){
     
            $cart = $request->session()->get('cart');
            if ($cart[$id]) {
                $cart[$id]['quantity'] ++;
                session()->put('cart', $cart);
                return redirect()->back();
            }
        }
 

    public function minusProductSession(Request $request, $id){
       
            $cart = $request->session()->get('cart');
            if ($cart[$id]) {
                $cart[$id]['quantity'] --;
                session()->put('cart', $cart);
                return redirect()->back();
            }
       
    }

    public function removeProductSession(Request $request, $id){
        
            $cart = $request->session()->get('cart');
            if ($cart[$id]) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back();
            }
       
        
    }

 
}
