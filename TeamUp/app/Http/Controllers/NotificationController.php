<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index(){
        return view('notification.index');
    }

    public function count(){
        if (Auth::user() == null) return null;

        return Notification::where('user_id', '=', Auth::user()->id)->count();
    }
}
