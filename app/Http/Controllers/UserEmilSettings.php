<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMailsetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class UserEmilSettings extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $userMailSetting = UserMailSetting::where('user_id', $user->id)->first();
              
        if ($userMailSetting) {
            return redirect()->route('user_email_settings.edit', $userMailSetting->id);
        } else {
            return view('user_email_settings.index');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        // Use $id to retrieve the UserMailSetting model instance
        $mailSetting = UserMailSetting::find($id);
        $user = Auth::user();
        if ($user->id != $mailSetting->user_id) {
            return redirect()->route('user_mail_settings.index')->with('error', 'Access denied.');
        }
        return view('user_email_settings.index', compact('mailSetting'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //     $validator = Validator::make($request->all(), [
    //         'primary_email' => 'required|string|unique:user_mail_settings,primary_email',
    //         'secondary_email' => 'nullable|string',
    //         'mail_server' => 'required|string',
    //         'port' => 'required|string',
    //         'protocol' => 'required|string',
    //         'password' => 'required|string'
    //     ]);
    //    // print_r($validator->fails());die;
    //     if ($validator->fails()) {
    //         // $errors = $validator->errors()->all();
    //         // print_r($errors);
    //         // exit;
    //         return back()->withErrors($validator);
    //     }
        $request->validate([
            'primary_email' => 'required|email|unique:user_mail_settings',
            'secondary_email' => 'nullable|email',
            'mail_server' => 'required',
            'port' => 'required',
            'protocol' => 'required',
            'password' => 'required',
        ]);
        
        $user = Auth::user();
        //print_r($user);die;
        // Create a new UserMailSetting instance and fill its properties
        $setting = new UserMailSetting;
        $setting->primary_email = $request->input('primary_email');
        $setting->secondary_email = $request->input('secondary_email');
        $setting->mail_server = $request->input('mail_server');
        $setting->port = $request->input('port');
        $setting->protocol = $request->input('protocol');
        $setting->password = $request->input('password');
        $setting->start_time = $request->input('start_time');
        $setting->end_time = $request->input('end_time');

        // Set the user ID
        $setting->user_id = $user->id;

        // Save the new user_mail_setting record
        $setting->save();
        return redirect()->route('user_mail_settings.index')->with('success', 'Mail settings updated successfully.');

        //return redirect(route('user_mail_settings.index'));
        //return redirect()->route('user_mail_settings.index')->with('success', 'User mail setting created successfully');
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserMailSetting $mailSetting)
    {
        $user = Auth::user();
        if ($user->id != $mailSetting->user_id) {
            return redirect()->route('user_mail_settings.index')->with('error', 'Access denied.');
        }
        
        $validator = Validator::make($request->all(), [
            'primary_email' => ['required', 'string', Rule::unique('user_mail_settings')->ignore($mailSetting->id)],
            'secondary_email' => 'nullable|string',
            'mail_server' => 'required|string',
            'port' => 'required|string',
            'protocol' => 'required|string',
            'password' => 'required|string'
        ]);
    }
}