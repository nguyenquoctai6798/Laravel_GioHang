<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use App\NotificationType;
use App\Notification;
use App\Products;
use App\Producttype;
use Validator;

class NotificationController extends Controller
{
    public function notificationManagement()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $lsNotification = Notification::getAllNotification();
                return view('NotificationManagement', ['lsNotification'=> $lsNotification]);
            } else {
                return redirect()->back();
            }
        } else {
            return redirecut('/Login');
        }
    }

    public function createNotification()
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $lsNotificationType = NotificationType::getAllNotificationType();
                return view('CreateNotification', ['lsNotificationType' => $lsNotificationType]);
            } else {
                return redirect()->back();
            }
        } else {
            return redirecut('/Login');
        }
    }

    public function createNotificationPost(Request $request)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                $validator = Validator::make($request->all(), [
        'title' => 'required|min:6',
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
                        Notification::creteNotificationPost($request, $fileRandom);
                        return redirect('/NotificationManagement')->with('success', 'Tạo sản phẩm thành công!');
                    }
                }
            } else {
                return redirect()->back();
            }
        } else {
            return redirect("/Login");
        }
    }

    public function deleteNotification($id)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            if (Auth::user()->role == 1) {
                Notification::deleteNotification($id);
                return redirect('/NotificationManagement')->with('success', 'Xóa sản phẩm thành công');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('/Login');
        }
    }

    public function editNotification($id)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            $notification = Notification::getNotificationById($id);
            if ($notification) {
                if (Auth::user()->role == 1) {
                    $lsNotificationType = NotificationType::getAllNotificationType();
                    return view('EditNotification', ['lsNotificationType' => $lsNotificationType, 'notification'=> $notification]);
                }
            } else {
                return redirect('/NotificationManagement')->with('error', 'Không có thông bào này');
            }
        } else {
            return redirect('/Login');
        }
    }

    public function editNotificationPost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
        'title' => 'required|min:6',
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
        if ($request->hasFile('myfile')) {
            $file = $request->file('myfile');
            $duoi = $file->getClientOriginalExtension();
            if ($duoi != "jpg" && $duoi != "png" && $duoi != "jpeg" && $duoi != "JPG" && $duoi != "PNG" && $duoi != "JPEG") {
                return redirect()->back()->with('error', 'Chỉ được thêm file .jpg/.png/.jpeg')->withInput(
                $request->except('')
            );
            } else {
                // xóa file product cũ
                $notification = Notification::getNotificationById($id);
                $uploadDir = public_path('Images');
                if (File::exists($uploadDir. '/' . $notification->img)) {
                    File::delete($uploadDir. '/' . $notification->img);
                } else {
                    return redirect()->back()->with('error', 'file hình không tìm thấy để xóa');
                }
                // thêm file product mới
                $fileName = $file->getClientOriginalName();
                $fileRandom = str_random(8). '_' .$fileName;
                $file->move('public/Images', $fileRandom);
            }
        }
   
        Notification::editNotification($request, $id, $fileRandom);
        return redirect('/NotificationManagement')->with('success', 'Thay đối sản phẩm thành công');
    }

    public function DetailNotification($id)
    {
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            $notification = Notification::getNotificationById($id);
            if ($notification) {
                if (Auth::user()->role == 1 || Auth::user()->role == 0) {
                    $lsNotificationType = NotificationType::getAllNotificationType();
                    return view('DetailNotification', ['lsNotificationType' => $lsNotificationType, 'notification'=> $notification]);
                }
            } else {
                return redirect('/NotificationManagement')->with('error', 'Không có thông bào này');
            }
        } else {
            return redirect('/Login');
        }
    }

    public function getAllNotificationUser()
    {
        $lsNotification = Notification::getAllNotification();
        $lsNotificationType = NotificationType::getAllNotificationType();
        $lsProductType = Producttype::getAllProductType();
        $lsNotification = Notification::getAllNotification();
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            return view('NotificationUser', ['lsNotification' => $lsNotification,'lsProductType'=>$lsProductType ,'lsNotificationType' => $lsNotificationType, 'name' => Auth::user()->name, 'img' => Auth::user()->img , 'lsNotification'=> $lsNotification]);
        } else {
            return view('NotificationGues', ['lsNotification' => $lsNotification,'lsProductType'=>$lsProductType ,'lsNotificationType' => $lsNotificationType, 'lsNotification'=> $lsNotification]);
        }
    }

    public function showNotification($id)
    {
        $lsNotificationType = NotificationType::getAllNotificationType();
        $lsProductType = Producttype::getAllProductType();
        $notification = Notification::getNotificationById($id);
        if ($notification) {
            if (Auth::check() && Auth::user()->email_verified_at == 1) {
                return view('DetailNotificationUser', ['lsProductType'=>$lsProductType ,'lsNotificationType' => $lsNotificationType, 'name' => Auth::user()->name, 'img' => Auth::user()->img, 'notification' => $notification ]);
            } else {
                return view('DetailNotificationGues', ['lsProductType'=>$lsProductType ,'lsNotificationType' => $lsNotificationType, 'notification' => $notification]);
            }
        } else {
            return redirect('/Notification')->with('error', 'Sản phẩm tìm kiếm không tồn tại!');
        }
    }

    public function notificationByNotificationType($id)
    {
        $lsProductType = Producttype::getAllProductType();
        $lsNotification = Notification::getNotificationByNotificationType($id);
        $lsNotificationType = NotificationType::getAllNotificationType();
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            return view('NotificationUser', ['name' => Auth::user()->name, 'img' => Auth::user()->img, 'lsProductType' => $lsProductType, 'lsNotification' => $lsNotification, 'lsNotificationType'=>$lsNotificationType]);
        } else {
            return view('NotificationGues', ['lsProductType' => $lsProductType, 'lsNotification' => $lsNotification, 'lsNotificationType'=>$lsNotificationType]);
        }
    }

    public function searchNotification(Request $request)
    {
        $lsNotification = Notification::getAllNotificationBySearch($request->key);
        $lsProductType = Producttype::getAllProductType();
        $lsNotificationType = NotificationType::getAllNotificationType();
        
        if (Auth::check() && Auth::user()->email_verified_at == 1) {
            return view('NotificationUser', ['lsNotification' => $lsNotification ,'name' => Auth::user()->name, 'img' => Auth::user()->img, 'lsProductType' => $lsProductType, 'lsNotificationType' => $lsNotificationType, 'lsNotificationType'=>$lsNotificationType]);
        } else {
            return view('NotificationGues', ['lsNotification' => $lsNotification, 'lsNotificationType' => $lsNotificationType, 'lsNotificationType'=>$lsNotificationType, 'lsProductType' => $lsProductType]);
        }
    }
}
