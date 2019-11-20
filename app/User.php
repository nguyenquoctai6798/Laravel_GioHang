<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
class User extends Authenticatable
{
    protected $table = 'users';
    public static function checkAccount($Email)
    {
        $user = User::all()->where('email', $Email)->first();
        return $user;
    }

    public static function getAllUser(){
        $lsUser = User::all()->where('role', 0);
        return $lsUser;
    }

    public static function getAccountbyId($id){
        $user = User::all()->where('id', $id)->first();
        return $user;
    }

    public static function getAccountbyMail($email){
        $user = User::all()->where('email', $email)->first();
        return $user;
    }
    public static function createAccount($request, $fileRandom)
    {
        $account = new User();
        $account->name = $request['name'];
        $account->email = $request['email'];
        $account->remember_token	 = $request['_token'];
        $account->email_verified_at = 0;
        $account->password = Hash::make($request['password']);
        $account->role = 0;
        $account->img = $fileRandom;
        $account->save();
    }

    public static function conFirm($token){
      $account = User::all()->where('remember_token', $token)->first();
      if($account == null){
       return 'error';
      }
      else{
           $account->email_verified_at = 1;
           $account->remember_token = null;
           $account->save();
           return 'success';
      }
  }

  

    
}
