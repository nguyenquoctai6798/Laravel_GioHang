<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table =  'notifications';
  public static function getAllNotification() {
      $lsNotification = Notification::all();
      return $lsNotification;
  }

  public static function creteNotificationPost($request, $fileRandom){
    $notification = new Notification;
    $notification->insert(['title'=>$request->title, 'img'=>$fileRandom, 'Content'=>$request->Description, 'id_notification' => $request->id_notification]);
  }

  public static function deleteNotification($id){
    $notification = Notification::where('id', $id);
    $notification->delete();
  }

  public static function getNotificationById($id){
      $notification = Notification::all()->where('id', $id)->first();
      return $notification;
  }

  public static function editNotification($request ,$id, $fileName){
   
    if($fileName != null){
        Notification::where('id', (int)$id)->Update(['title'=>$request->title, 'id_notification'=>$request->id_notification,'img'=>$fileName, 'Content'=>$request->Description]);
    }
    else{
        Notification::where('id', (int)$id)->Update(['title'=>$request->title, 'id_notification'=>$request->id_notification, 'Content'=>$request->Description]);
    }
  }

  public static function getNotificationByNotificationType($id){
    $lsNotification = Notification::all()->where('id_notification', $id);
    return $lsNotification;
  }

  public static function getAllNotificationBySearch($key){
    $lsNotification = Notification::where('title', 'LIKE', '%'. $key . '%' )->get()    ;
        return $lsNotification;  
  }

}

