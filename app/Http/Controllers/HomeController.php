<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserMailsetting;
use Illuminate\Support\Facades\Auth;


    
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $userMailSetting = UserMailSetting::where('user_id', $user->id)->first();
              
        if ($userMailSetting) {
            return redirect()->route('user_mail_settings.edit', $userMailSetting->id);
        } else {
          return redirect()->route('user_mail_settings.create');
        }
    }
}
