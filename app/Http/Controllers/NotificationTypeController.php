<?php

namespace App\Http\Controllers;
use App\NotificationType;
use Illuminate\Http\Request;
use Auth;
use Validator;

class NotificationTypeController extends Controller
{
    public function notificationTypeManagement()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1 || Auth::user()->role == 0) {
                $lsNotificationType = NotificationType::getAllNotificationType();
                return view('NotificationTypeManagement', ['lsNotificationType' => $lsNotificationType]);
            }
        } else {
            return redirect('/Login');
        }
    }

    public function addNotificationType(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->with('errors', $validator->errors());
        }
        else{

        } if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                NotificationType::addNotificationType($request);
                return redirect()->back()->with('success', 'Thêm sản phẩm thành công');
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
       
    }

    public function deleteNotificationType($id){
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                NotificationType::deleteNotificationType($id);
                return redirect('/NotificationTypeManagement')->with('success', 'Xóa loại sản phẩm thành công');
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect('/Login');
        }
    }

    public function getAllNotificationType(){
        $lsNotificationType = NotificationType::getAllNotificationType();
        return $lsNotificationType;
    }



}
