<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    protected $table = 'notificationtype';
    public static function addNotificationType($request){
        $notificationType = new NotificationType;
        $notificationType->name= $request->name;
        $notificationType->save();
    }

    public static function getAllNotificationType(){
        $lsNotificationType = NotificationType::all();
        return $lsNotificationType;
    }


    public static function deleteNotificationType($id){
        NotificationType::where('id', $id)->delete();
    }

   
  
}
