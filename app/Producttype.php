<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producttype extends Model
{
    protected $table = 'producttype';
    public function products(){
        return $this->hasMany('App\Products');
    }

    public static function addProductType($request){
        $producttype = new Producttype;
        $producttype->name= $request->nameproduct;
        $producttype->save();
    }

    public static function getAllProductType(){
        $lsProductType = Producttype::all();
        return $lsProductType;
    }

    public static function deleteProductType($id){
        Producttype::where('id', $id)->delete();
    }

}
