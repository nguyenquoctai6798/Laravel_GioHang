<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public static function getAllProduct(){
        $lsProduct = Products::all();
        return $lsProduct;
    }

    public static function creteProductPost($request, $fileName){
        $product = new Products;
        $product->insert(['Name'=>$request->Name, 'Price'=>$request->Price, 'Img'=>$fileName, 'Description'=>$request->Description, 'id_producttype' => $request->id_producttype]);
    }

    public static function getProductId($id){
        $product = Products::where('Id', $id)->get();
        return $product;
    }
    public static function deleteProduct($id){
        $product = Products::where('Id', $id);
        $product->delete();
    }

    public static function editProduct($request ,$id, $fileName){
        $product = new Products;
        $product->Name = $request->Name;
        $product->Price = $request->Price;
        $product->Description = $request->Description;
        if($fileName != null){
            $product::where('Id', (int)$id)->Update(['Name'=>$product->Name, 'Price'=>$product->Price,'Img'=>$fileName, 'Description'=>$product->Description]);
        }
        else{
            $product::where('Id', (int)$id)->Update(['Name'=>$product->Name, 'Price'=>$product->Price, 'Description'=>$product->Description]);
        }
       
    }

    public static function productByProductType($id){
        $lsProduct = products::all()->where('id_producttype', $id);
        return $lsProduct;
    }

    public static function getAllProductBySearch($key){

        $lsProduct = products::where('Name', 'LIKE', '%'. $key . '%' )->get()    ;
        return $lsProduct;  
    }
}
